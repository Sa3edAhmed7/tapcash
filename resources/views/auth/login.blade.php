@extends('layouts.master')

@section('content')

<section class="section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-10">
				<div class="shadow rounded p-5 bg-white">
					<div class="row">
						<div class="col-12 mb-4">
							<h4>Login</h4>
						</div>
						<div class="col-lg-6">
							<div class="contact-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
									<div class="form-group mb-4 pb-2">
										<label for="exampleFormControlInput1" class="form-label" :value="__('Email')">Email</label>
										<input type="email" class="form-control shadow-none" id="contact_email" name="email" :value="old('email')" required autofocus autocomplete="username">
									</div>
                                    <div class="form-group mb-4 pb-2">
										<label for="exampleFormControlInput1" class="form-label" :value="__('Password')">Password</label>
										<input type="password" class="form-control shadow-none"name="password" required autocomplete="current-password" />
									</div>
                                    <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                  Remember me
                                </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-body"> {{ __('Forgot Your Password?') }}</a>
                                    @endif
									<button class="btn btn-primary w-100" type="submit">Login</button>
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