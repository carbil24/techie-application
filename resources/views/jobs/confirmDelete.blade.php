@extends('layout')

@section('title', 'Jobs | ' . $job->title)

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">
        <h2 class="bg-danger text-center text-white py-3 shadow">Please confirm the deletion of this job.</h2>

            <div class="bg-white p-5 shadow rounded">
                <h1 class="display-4 mb-1">{{ $job->title }}</h1>
                <h3 class="display-5 mb-1">{{ $job->company }} - {{ $job->location }}</h3>

                <p class="text-secondary">{{ $job->description }}</p>
                <p class="text-black-50">{{ $job->created_at -> diffForHumans() }}</p>

                <a class="btn btn-danger btn-lg btn-block" href="#" onclick="document.getElementById('delete-job').submit();">Confirm</a>
                <a class="btn btn-link btn-block" href="{{ route('jobs.index') }}">Cancel</a>


            </div>
            <form class="d-none" id="delete-job" method='POST' action="{{ route('jobs.destroy', $job) }}">
                    @csrf @method('DELETE')
                </form>
        </div>
    </div> 
</div> 

@endsection