<nav class="navigation -white -floating">
    <a class="navigation__logo" href="/"><span>DoSomething.org</span></a>
    <div class="navigation__menu">
        <ul class="navigation__primary">
            <li><a class="navigation__title" href="/">Home</a></li>
            <li><a class="navigation__title" href="{{ route('redirects.index') }}">Redirects</a></li>
            <li><a class="navigation__title" href="{{ route('redirects.create') }}">Create a redirect</a></li>
        </ul>
        <ul class="navigation__secondary">
			@if (Auth::check())
				<li><a class="navigation__title" href="/logout">Logout</a></li>
			@else
				<li><a class="navigation__title" href="/login">Login</a></li>
			@endif
        </ul>
    </div>
</nav>
