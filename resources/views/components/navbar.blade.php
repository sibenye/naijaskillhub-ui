<div>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}" alt="{{ config('app.name',
				'Naija Skill Hub') }}">  <img width=300 height=70 alt="Brand" src="{{ asset('images/nsh_logo_transparent.png') }}"></a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">&nbsp;
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				@component('components.navbaritems')
				@endcomponent
			</ul>
		</div>
	</div>
</nav>
<div class="nsh-divider"></div>
</div>
