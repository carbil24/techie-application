@extends('layout')

@section('title', 'Jobs')


@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">

            <div class="bg-white p-5 shadow rounded">

                <h1 class="text-primary display-4 mb-0">Jobs</h1>
                <hr>

                <div class="col-12 col-sm-10 col-lg-6 mx-auto">

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
                </div>

                <ul class="list-group">
                    @forelse($jobs as $job)
                    <li class="list-group-item border-0 mb-3 shadow-sm">
                        <h2><a class="text-secondary d-flex justify-content-between align-items-center" href="{{ route('jobs.show', $job) }}">{{ $job->title }} - {{ $job->company }}</a></h2>
                        <h4>{{ $job->company }}</h4>
                        <p>{{ $job->location }}</p>
                        <p>{{ $job->created_at->format('d/m/Y') }}</p>
                    
                        <div class="d-flex justify-content-end align-items-center">
                            @auth
                                @if (Auth::user()->email=='admin@techie.com')
                                    <a class="btn btn-primary" href="{{ route('jobs.edit', $job) }}">Edit</a>
                                <a class="btn btn-danger" href="{{ route('jobs.confirmDelete', $job) }}">Delete</a>

                                <!-- <form class="d-none" id="delete-job" method='POST' action="{{ route('jobs.destroy', $job) }}">
                                    @csrf @method('DELETE')
                                </form> -->
                                @else

                                    @if($job->users()->where('id', Auth::user()->id) ->exists())
                                        <a class="btn btn-primary mr-2 star-liked" href="{{ route('like_job', $job) }}">★</a>
                                    @else
                                        <a class="btn btn-outline-primary mr-2 star" href="{{ route('like_job', $job) }}">★</a>
                                    @endif
                                    <a class="btn btn-primary" href="{{ route('applyToJob', $job) }}">Apply</a>

                                @endif
                            @else
                                    <a class="btn btn-outline-primary mr-2 star" href="{{ route('login') }}" onclick="alert('You need to be logged in to like a job');" class="star">★</a>
                                    <a class="btn btn-outline-primary" href="{{ route('login') }}" onclick="alert('You need to be logged in to apply');">Apply</a>
                            @endauth
                        </div>      
                    @empty
                        <li class="list-group-item border-0 mb-3 shadow-sm">There is no jobs to show</li>
                    @endforelse
                    </li>
                    {{ $jobs->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection