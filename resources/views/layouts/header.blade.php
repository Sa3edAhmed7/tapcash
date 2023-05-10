<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="index">
				<img loading="prelaod" decoding="async" class="img-fluid" width="160" src="{{asset('assets/images/logo.png')}}" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="/index">Home</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="/about">About</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="/how-it-works">How It Works</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="/services">Services</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="/contact">Contact</a>
					</li>
					<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item " href="/blog">Blog</a>
							</li>
							<li><a class="dropdown-item " href="/blog-details">Blog Details</a>
							</li>
							<li><a class="dropdown-item " href="/service-details">Service Details</a>
							</li>
							<li><a class="dropdown-item " href="/faq">FAQ&#39;s</a>
							</li>
							<li><a class="dropdown-item " href="/legal">Legal</a>
							</li>
							<li><a class="dropdown-item " href="/terms">Terms &amp; Condition</a>
							</li>
							<li><a class="dropdown-item " href="/privacy-policy">Privacy &amp; Policy</a>
							</li>
						</ul>
					</li>
				</ul>
				@if(Route::has('login'))
				@auth
				<ul type="none">
				<li class="nav-item dropdown"> <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->name}}</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">	
				<a class="dropdown-item" href="{{route('profile.edit')}}"> {{ __('Profile') }}</a>
					</li>
					<li class="nav-item">
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
						</form>
					</li>
				</ul>
				</ul>
				
					
				@else
				<!-- account btn --> <a href="{{route('login')}}" class="btn btn-outline-primary">Log In</a>
				<!-- account btn --> <a href="{{route('register')}}" class="btn btn-primary ms-2 ms-lg-3">Register</a>
				@endif
				@endif
			</div>
		</div>
	</nav>
</header>
<!-- /navigation -->