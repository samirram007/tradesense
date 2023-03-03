@extends('layouts.main')
@section('content')
    <div class="container">

        <div class="row justify-content-center px-0 mx-n4 pt-4 ">
            <div class="col-12 col-md-8 pt-4  ">
                <div class="card bg-dark text-light border-bottom-0 border-left-0 border-right-0 border-top border-warning border-4">
                    <h5 class="card-header py-4">{{ __('Registration (STEP 2) : Position  ') }}</h5>

                    <div class="card-body">
                        <form id="registerFormStep2" >
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-8 my-auto">{{ $name }}</div>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class=" sr-only  " name="name"
                                        value="{{ $name }}"  >


                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="email" class="col-4 col-form-label text-md-end">{{ __('Email ') }}</label>

                                <div class="col-8 my-auto">{{ $email }}</div>

                            </div>

                            <div class="row mb-3">
                                <label for="sponsor_code"
                                    class="col-4 col-form-label text-md-end">{{ __('Sponsor Code') }}</label>

                                <div class="col-8">
                                    <input type="text" class="sr-only" name="sponsor_id" id="sponsor_id">
                                    <div class="input-group">


                                        <input id="sponsor_code" type="text"
                                            class="form-control @error('sponsor_code') is-invalid @enderror"
                                            name="sponsor_code" value="{{ old('sponsor_code') }}" maxlength="10"
                                            size="10" required autocomplete="sponsor_code">
                                        <div class="input-group-btn">
                                            <a href="javascript:" onClick="get_sponsor();" class="btn btn-info"><i class="fa fa-search"></i></a>
                                        </div>
                                        @error('sponsor_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3   position ">
                                <label for="position"
                                    class="col-4 col-form-label text-md-end">{{ __('Position ') }}</label>

                                <div class="col-8 my-auto disabled">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="position" id="LEFT"
                                            value="LEFT">
                                        <label class="form-check-label" for="LEFT">LEFT</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="position" id="RIGHT"
                                            value="RIGHT">
                                        <label class="form-check-label" for="RIGHT">RIGHT</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="row mb-3 d-none">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 d-none">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Passcode') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" value="{{ $code }}"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 d-none">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" value="{{ $code }}"
                                            class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-0 mt-3 ">
                                <div class="col-12  text-center">
                                    <button id="submitBtn" type="button" class="submit btn btn-primary disabled">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row sr-only  prepare">
                                <div class="col-12  ">
                                   <div class="text-mute text-center py-2">
                                    Please be patient while we prepare your account. This may take a few minutes.
                                   </div>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function get_sponsor() {
                var sponsor_code = $('#sponsor_code').val();
                if (sponsor_code == '') {
                    alert('Please enter sponsor code');
                    return false;
                }
                $.ajax({
                    url: '{{ route('get_sponsor') }}',
                    type: 'POST',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'sponsor_code': sponsor_code
                    },
                    success: function(response) {

                        if (response.status == 'success') {
                            //console.log(response.data);
                            toastr.info('sponsor found');
                            $('#sponsor_id').val(response.data.id);
                            $('#sponsor_code').val(response.data.code + ' - ' + response.data.name);
                            $('.submit').removeClass('disabled');
                            $('.position').removeClass('sr-only');
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }

            $('.submit').on('click',function(e) {
            //e.preventDefault();
            var form = $('#registerFormStep2');
            var url ='{{ route('register_through_link')}}';
            var formData = new FormData(form[0]);
           //console.log(formData);
            // $('#spinner').show();
            $('.submit').html('please wait... ! while we prepare your account');
            $('.submit').attr('disabled', true);

            $.ajax({
                type: "POST",
                url: url,
                _token: '{{ csrf_token() }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'success') {
                        // $('#spinner').hide();
                        toastr.info(data.message);
                        $("#registerFormStep2").trigger("reset");
                        window.location.href = "{{ route('welcome') }}";
                        //$("#RegisterModal").modal('hide');
                        // setTimeout(() => {
                        //     closeRegisterForm();
                        // }, 3000);
                        // location.reload();
                    } else {


                        toastr.error(data.message);
                        $('#registerFormStep2 .submit').html('Register');
                        $('#registerFormStep2 .submit').attr('disabled', false);
                    }
                },
                error: function(data) {
                    toastr.error(data.message);
                        $('#registerFormStep2 .submit').html('Register');
                        $('#registerFormStep2 .submit').attr('disabled', false);
                }
            });
        });
        </script>
    </div>
@endsection
