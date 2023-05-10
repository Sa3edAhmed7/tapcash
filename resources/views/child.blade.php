@extends('layouts.layout')
@section('content')

<section class="section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="shadow rounded p-5 bg-white">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h4>Create Child Account</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form">
                                <form method="POST" action="{{ route('child.store') }}">
                                    @csrf
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="__('Name')">Name</label>
                                        <input id="name" type="name" class="form-control shadow-none" name="name" required autofocus autocomplete="username">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" class="form-control shadow-none" id="contact_email" name="email"required autofocus autocomplete="username">
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                                        <input type="password" class="form-control shadow-none" name="password" required autocomplete="current-password" />
                                    </div>
                                    <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
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
                            </div>
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0">
                            <div class="contact-info">
                                <div class="block mt-0">
                                    <img src="{{asset('assets/images/login.svg')}}" class="img-fluid  d-xxxl-none pb-2" alt="Sample image">
                                </div>
                                <br>
                                <br>
                                <div class="form-group mb-4 pb-2">
                                        <label for="exampleFormControlInput1" class="form-label" :value="">Money Limit</label>
                                        <input type="number" class="form-control shadow-none" name="money_limit" required autofocus autocomplete="age">
                                    </div>
                                    <h3>Purchases Limitaion</h3>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2"name="food" type="checkbox" value="food" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                          Food
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" name="clothes"type="checkbox" value="clothes" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Clothes
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" name="electorincs"type="checkbox" value="electorincs" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Electorincs
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" name="drinks"type="checkbox" value="Drinks_haven't_alcohol" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                        Drinks haven't alcohol 
                                        </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" name="cigarettes"type="checkbox" value="cigarettes" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                        cigarettes
                                        </label>
                                    </div>
                                    
                            </div>
                        </div>
                        <button class="btn btn-primary w-50 mx-auto" type="submit">Create Child Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection