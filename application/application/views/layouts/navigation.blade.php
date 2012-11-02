<div id="cntr-navigation">
    <ul>
        @if (Auth::check())
        <li>{{ HTML::link('/dashboard', 'Dashboard') }}</li>
        <li>{{ HTML::link('/profile/'.Auth::user()->username, 'Profile') }}</li>
        <li>{{ HTML::link('/galleries', 'Galleries') }}</li>
        <li>{{ HTML::link('/logout', 'Logout') }}</li>
        @else
        <li>{{ HTML::link('/login', 'Login') }}</li>
        @endif
    </ul>
</div>
