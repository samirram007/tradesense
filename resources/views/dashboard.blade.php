@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-0 mx-n4 pt-4 ">
            <div class="col-12 col-md-8 pt-4  ">
                <div
                    class="card bg-dark text-light border-bottom-0 border-left-0 border-right-0 border-top border-warning border-4">
                    <h5 class="card-header py-4">{{ __('Registration (STEP 2) : Position  ') }}</h5>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
