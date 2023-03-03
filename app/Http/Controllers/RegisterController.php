<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MailLink;
use Illuminate\Http\Request;
use App\Models\JoiningRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function send_link()
    {
        return view('auth.send_link');
    }
    public function send_link_email(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            $code = rand(100000, 999999);
            $data = [
                'name' => $request->name,
                'code' => $code,
            ];
            $email = $request->email;
            $mail_link = MailLink::where('email', $email)->first();

            if ($mail_link == null) {
                $mail_link = new MailLink();
                $mail_link->name = $request->name;
                $mail_link->email = $email;
                $mail_link->code = $code;
                $mail_link->save();
            } else {
                $mail_link->code = $code;
                $mail_link->save();
            }

            //mail send exception

            //dd($mail_link);
            Mail::send('auth.registration_link', $data, function ($message) use ($email) {
                $message->to($email)->subject('Registration Link');
            });
            //dd($mail_link);
            return response()->json(['status' => 'success', 'message' => 'Link sent to your email address']);
            // return view('auth.reg_mail_send',compact('email'))->with('success', 'Link sent to your email address');
            //return redirect()->back()->with('success', 'Verification link sent to your email address');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Email already exists']);
            //return redirect()->back()->with('error', 'Email already exists');
            //   return redirect()->back()->with('error', 'Email already in use');
        }

    }
    public function registration_link_body($code)
    {
        // $user = User::where('code', $code)->first();
        if ($code == null) {
            return redirect()->route('send_link')->with('error', 'Invalid link');
        } else {
            return view('auth.registration_link', compact('code'));
        }
    }
    protected function confirm_registration_link($code)
    {
        $mail_link = MailLink::where('code', $code)->first();
        if ($mail_link) {
            $user = User::where('email', $mail_link->email)->first();
            if ($user == null) {
                $data = [
                    'name' => $mail_link->name,
                    'email' => $mail_link->email,
                    'code' => $code,
                ];
                return view('auth.confirm_registration_link', $data)->with('success', 'email varified successfully');

            } else {
                //  toastr()->error('Email already exists');
                return redirect('/')->with('error', 'Email already exists');
            }

        } else {
            // toastr()->error('Invalid confirmation link.');
            return redirect('/')->with('error', 'Invalid link');
        }

    }
    protected function get_parent(Request $request)
    {
        $user = User::where('code', $request->parent_code)->first();
        if ($user) {
            return response()->json(['status' => 'success', 'data' => $user]);
        }
    }
    protected function get_sponsor(Request $request)
    {
        $user = User::where('code', $request->sponsor_code)->first();
        if ($user) {
            return response()->json(['status' => 'success', 'data' => $user]);
        }
    }
    protected function register_through_link(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required',
            'sponsor_id' => 'required|integer|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }

        $parent_id = $this->getParentId($request->sponsor_id, $request->position);

        //dd($validator->errors());
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $code = $this->get_unique_code();

        $passcode = rand(100000, 999999);
        $user = User::create([
            'name' => $request->name,
            'code' => 'TS' . $code,
            'email' => $request->email,
            'position' => $request->position,
            'sponsor_id' => $request->sponsor_id,
            'parent_id' => $parent_id,
            'password' => Hash::make($passcode),
            'passcode' => $passcode,
            'status' => 'active',
        ]);
        //dd($user);

        // dd($user);
        $this->send_email($request->name, $request->email, $user->code, $passcode);

        // $credentials = [
        //     'email' => $request->email,
        //     'password' => $passcode,
        //     '_token' => $request->input('_token'),
        // ];

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }
        toastr.success('Registration successful');
        toastr.info('Please check your email for passcode');
        return response()->json(['status' => 'success', 'message' => 'Please check your email for passcode']);
        // return redirect()->route('welcome')->with('success', 'Please check your email for passcode');
    }
    protected function send_email($name, $email, $code, $passcode)
    {
        $data = array('name' => $name, 'email' => $email, 'code' => $code, 'passcode' => $passcode);
        Mail::send('auth.email_passcode', $data, function ($message) use ($data) {
            $message->to($data['email'])->subject('Secure:: TS Accesscode');
        });
    }
    protected function getParentId($sponsor_id, $position)
    {
        $parent_id = 0;
        if ($position == 'left') {
            $parent_id = User::where('sponsor_id', $sponsor_id)->where('position', 'left')->select('id')->first();
        } else {
            $parent_id = User::where('sponsor_id', $sponsor_id)->where('position', 'right')->select('id')->first();
        }
        if ($parent_id) {
            $parent_id = $this->getParentId($parent_id->id, $position);
        } else {
            $parent_id = $sponsor_id;
        }
        return $parent_id;

    }
    protected function get_unique_code()
    {
        $code = rand(10000000, 99999999);
        $user = User::where('code', $code)->first();
        if ($user) {
            $code = $this->get_unique_code();
        }
        return $code;
    }
    protected function confirm_joining_link($code)
    {
        $mail_link = JoiningRequest::where('code', $code)->first();
        if ($mail_link) {
            $user = User::where('email', $mail_link->email)->first();
            $parent_user = User::where('id', $mail_link->user_id)->first();
            if ($user == null) {
                $data = [
                    'email' => $mail_link->email,
                    'code' => $code,
                    'name' => $mail_link->name,
                    'parent_user' => $parent_user,
                ];
                $u_code = $this->get_unique_code();

                $passcode = rand(100000, 999999);
                $user = User::create([
                    'name' => $data['name'],
                    'code' => 'TS' . $u_code,
                    'email' => $mail_link->email,
                    'parent_id' => $parent_user->id,
                    'password' => Hash::make($passcode),
                    'passcode' => $passcode,
                ]);
                //dd($user);
                $this->send_email($data['name'], $data['email'], $user->code, $passcode);

                $notification = [
                    'success' => 'User created successfully',
                ];
                toast($notification['success'], 'success');
                return redirect()->route('landing')->with($notification);

                //return view('auth.confirm_joining_link', $data)->with('success', 'email varified successfully');

            } else {
                return redirect('/landing')->with('error', 'Invalid confirmation link.');
            }

        } else {
            return redirect('/landing')->with('error', 'Invalid link');
        }

    }

}
