@extends('layouts.master')

@section('content')

<section class="section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="shadow rounded p-5 bg-white">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h4>Regsiter</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('Name')">Name</label>
                                        <input id="name" type="name" class="form-control shadow-none" name="name" required autofocus autocomplete="username">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('Email')">Email</label>
                                        <input type="email" class="form-control shadow-none" id="contact_email" name="email" :value="old('email')" required autofocus autocomplete="username">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('Password')">Password</label>
                                        <input type="password" class="form-control shadow-none" name="password" required autocomplete="current-password" />
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('Confirm Password')">Confirm Password</label>
                                        <input type="password" class="form-control shadow-none" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('phone')">phone</label>
                                        <input id="phone" type="text" class="form-control shadow-none" name="phone" required autofocus autocomplete="phone">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('national_id')">National ID</label>
                                        <input id="national_id" type="text" class="form-control shadow-none" name="national_id" required autofocus autocomplete="national_id">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('city')">City</label>
                                        <input id="city" type="text" class="form-control shadow-none" name="city" required autofocus autocomplete="national_id">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('gender')">Gender</label>
                                        <input id="gender" type="text" class="form-control shadow-none" name="gender" required autofocus autocomplete="gender">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('age')">Age</label>
                                        <input id="age" type="text" class="form-control shadow-none" name="age" required autofocus autocomplete="age">
                                    </div>

                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <div class="contact-info">
                                <div class="block mt-0">
                                    <img src="{{asset('assets/images/login.svg')}}" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection