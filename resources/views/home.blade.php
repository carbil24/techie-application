@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <div class="bg-white p-5 shadow rounded">
            @auth
                @if (Auth::user()->email=='admin@techie.com')
                <h1 class="col-12 text-primary text-center display-5 mb-3">{{ 'Please select an option: '}} </h1>
                <a class="btn btn-primary btn-lg btn-block" href="{{ route('jobs.index') }}">Job Management</a>
                <a class="btn btn-primary btn-lg btn-block" href="{{ route('jobs.create') }}">Add a new job</a>
                <a class="btn btn-primary btn-lg btn-block" href="{{ route('contacts.index') }}">Contact Management</a>


                @else
                    <h1 class="col-12 text-primary text-center display-5 mb-0">{{ 'Hey ' . auth()->user()->first_name . ' find the tech job right for you!'}} </h1>
                    <hr>
                    <form method="GET" action="{{ route('jobs.search') }}">
                        @csrf
                        <div class="form-group row">
                        <label for="location" class="col-md-2 col-form-label">{{ __('Location') }}</label>
                        <div class="col-md-10">
                            <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" autocomplete="location" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keyword" class="col-md-2 col-form-label">{{ __('Keyword') }}</label>

                            <div class="col-md-10">
                                <input id="keyword" type="text" class="form-control" name="keywords" value="{{ old('keyword') }}" autocomplete="keyword" autofocus>
                            </div>
                        </div>
                        <button class="btn btn-secondary btn-md btn-block mb-5">Search</button>
                    </form>

                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{URL::asset('/images/undraw_online_cv_qy9w.png')}}" width="50%" alt="image"/>
                    </div>
                @endif
            @else
                <h1 class="col-12 text-primary text-center display-5 mb-0">{{ 'Welcome to TECHIE. Find the tech job right for you!'}} </h1>
                <hr>
                <form method="GET" action="{{ route('jobs.search') }}">
                    @csrf
                    <div class="form-group row">
                    <label for="location" class="col-md-2 col-form-label">{{ __('Location') }}</label>
                    <div class="col-md-10">
                        <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" autocomplete="location" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keyword" class="col-md-2 col-form-label">{{ __('Keyword') }}</label>

                        <div class="col-md-10">
                            <input id="keyword" type="text" class="form-control" name="keywords" value="{{ old('keyword') }}" autocomplete="keyword" autofocus>
                        </div>
                    </div>
                    <button class="btn btn-secondary btn-md btn-block mb-5">Search</button>
                </form>   
                <div class="d-flex justify-content-center align-items-center">
                    <a class="btn btn-primary btn-lg btn-block mb-2" href="{{ route('login') }}">Login</a>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('register') }}">Register</a>
                </div> 
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{URL::asset('/images/undraw_online_cv_qy9w.png')}}" width="50%" alt="image"/>
                </div>

            @endauth

            </div>
        </div>             
    </div>
</div>

@endsection
