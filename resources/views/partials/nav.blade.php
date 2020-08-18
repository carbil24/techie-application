<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="text-primary display-2 navbar-brand" href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link {{ setActive('home') }}" href="{{ route('home') }}">Home</a></li>

                @guest
                    <li class="nav-item"><a class="nav-link {{ setActive('jobs.*') }}" href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link {{ setActive('contacts.create') }}" href="{{ route('contacts.create') }}">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ setActive('login') }}" href="{{ route('login') }}">Login</a></li>

                @else
                    @if (Auth::user()->email=='admin@techie.com')
                    <li class="nav-item"><a class="nav-link {{ setActive('jobs.*') }}" href="{{ route('jobs.index') }}">Job Management</a></li>
                    <li class="nav-item"><a class="nav-link {{ setActive('jobs.create') }}" href="{{ route('jobs.create') }}">Add a job</a></li>
                    <li class="nav-item"><a class="nav-link {{ setActive('contacts.index') }}" href="{{ route('contacts.index') }}">Contact Management</a></li>


                    @else
                        <li class="nav-item"><a class="nav-link {{ setActive('jobs.*') }}" href="{{ route('jobs.index') }}">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link {{ setActive('likedjobs') }}" href="{{ route('likedjobs') }}">Liked Jobs</a></li>
                        <li class="nav-item"><a class="nav-link {{ setActive('contacts.create') }}" href="{{ route('contacts.create') }}">Contact Us</a></li>

                    @endif
                <li class="nav-item"><a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >Logout</a>
                </li>   
                 
                @endguest

            </ul>
        </div>
        @auth
        <span class="nav nav-pills">
        @if (Auth::user()->email=='admin@techie.com')
            <span class="text-primary" >Admin</span>                   
        @else
            @if (Auth::user()->completed =='yes')
                <a class="nav-link {{ setActive('profile') }} " href="{{ route('profile') }}">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
            @else
                <a class="nav-link {{ setActive('profile') }} " href="{{ route('profile') }}">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
                <a href="{{ route('profile') }}" ><i class="fa fa-exclamation-circle fa-2x text-danger" aria-hidden="true" title="Please complete your profile"></a></i>
            @endif    
        @endif
            </span>
        @endauth

        <button class="navbar-toggler" type="button" 
                data-toggle="collapse" 
                data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>