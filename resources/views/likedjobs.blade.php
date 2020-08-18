@extends('layout')

@section('title', 'Liked Jobs')


@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">

            <div class="bg-white p-5 shadow rounded">

                <h1 class="text-primary display-4 mb-0">Liked Jobs</h1>
                <hr>
                <ul class="list-group">
                    @forelse($user->jobs as $job)
                    <li class="list-group-item border-0 mb-3 shadow-sm">
                        <h2><a class="text-secondary d-flex justify-content-between align-items-center" href="{{ route('jobs.show', $job) }}">{{ $job->title }} - {{ $job->company }}</a></h2>
                        <p>{{ $job->company }}</p>
                        <p>{{ $job->location }}</p>
                        <p>{{ $job->created_at->format('d/m/Y') }}</p>
                        <div class="d-flex justify-content-end align-items-center">

                            @auth
                                @if (Auth::user()->email=='admin@techie.com')
                                    <a class="btn btn-primary" href="{{ route('jobs.edit', $job) }}">Edit</a>
                                @else

                                    @if($job->users()->where('id', Auth::user()->id) ->exists())
                                        <a class="btn btn-primary mr-2" href="{{ route('like_job', $job) }}" class="star star-liked">★</a>
                                    @else
                                        <a class="btn btn-primary mr-2" href="{{ route('like_job', $job) }}" class="star">★</a>
                                    @endif
                                    <a class="btn btn-primary" href="{{ route('applyToJob', $job) }}">Apply</a>

                                @endif
                            @else
                                    <a class="btn btn-primary mr-2" href="{{ route('login') }}" class="star">★</a>
                                    <a class="btn btn-primary" href="#" onclick="alert('You need to be logged in to apply');">Apply</a>
                            @endauth
                        </div>      
                    @empty
                        <li class="list-group-item border-0 mb-3 shadow-sm">There is no jobs to show</li>
                    @endforelse
                    </li>
                </ul>
                <a class="btn btn-link btn-block" href="{{ route('jobs.index') }}">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection