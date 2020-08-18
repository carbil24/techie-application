@extends('layout')

@section('title', 'Jobs | ' . $job->title)


@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">

            <div class="bg-white p-5 shadow rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-primary display-4 mb-1">{{ $job->title }}</h1>
                    @guest
                        <a class="btn btn-outline-primary mr-2 star" href="{{ route('login') }}" onclick="alert('You need to be logged in to like a job');" class="star">★</a>
                    @else                    
                        @if (Auth::user()->email<>'admin@techie.com')
                            @if($job->users()->where('id', Auth::user()->id) ->exists())
                                <a class="btn btn-primary mr-2 star-liked" href="{{ route('like_job', $job) }}">★</a>
                            @else
                                <a class="btn btn-outline-primary mr-2 star" href="{{ route('like_job', $job) }}">★</a>
                            @endif
                        @endif
                    @endguest
                </div>
                <h3 class="display-5 mb-1">{{ $job->company }} - {{ $job->location }}</h3>
                <p class="text-secondary">{{ $job->description }}</p>
                <p class="text-black-50">{{ $job->created_at -> diffForHumans() }}</p>                 
                @auth
                    @if (Auth::user()->email=='admin@techie.com')
                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('jobs.edit', $job) }}">Edit</a>
                        <a class="btn btn-danger btn-lg btn-block" href="#" onclick="document.getElementById('delete-job').submit();">Delete</a>
                        <a class="btn btn-link btn-block" href="{{ route('jobs.index') }}">Cancel</a>                  
                    @else
                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('applyToJob', $job) }}">Apply</a>
                        <a class="btn btn-link btn-block btn-lg btn-block" href="{{ route('jobs.index') }}">Back</a>
                    @endif
                @else
                    <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}" onclick="alert('You need to be logged in to apply');">Apply</a>
                    <a class="btn btn-link btn-block btn-lg btn-block" href="{{ route('jobs.index') }}">Back</a>
                @endauth  
            </div>
            <form class="d-none" id="delete-job" method='POST' action="{{ route('jobs.destroy', $job) }}">
                @csrf @method('DELETE')
            </form>
        </div>
    </div> 
</div> 

@endsection

