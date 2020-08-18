@extends('layout')

@section('title', 'Edit Job')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-8 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4"
                method="POST" 
                action="{{ route('jobs.update', $job) }}"
            >
            @csrf @method('PATCH')
                <h1 class="text-primary display-4">Edit Job</h1>
                <hr>

                <div class="form-group">
                    <label for="title">Job Title</label>
                    <input class="form-control bg-light shadow-sm
                                @error('title')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="title" 
                        name="title"
                        placeholder="Please enter the title..." 
                        value="{{ old('title', $job->title) }}"
                    >
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                    <!--{!! $errors->first('name', '<small>:message</small><br/>') !!} -->
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input class="form-control bg-light shadow-sm
                                @error('company')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="company" 
                        name="company"
                        placeholder="Please enter the name of the company..." 
                        value="{{ old('company', $job->company) }}"
                        >
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input class="form-control bg-light shadow-sm
                                @error('location')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="location" 
                        name="location"
                        placeholder="Please enter the location..." 
                        value="{{ old('location', $job->location) }}"
                    >
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Job description</label>
                    <textarea class="form-control bg-light shadow-sm
                                @error('description')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="description" 
                        name="description"
                        placeholder="Please enter the job description...">{{ old('description', $job->description) }}
                    </textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <button class="btn btn-primary btn-lg btn-block";>Update</button>
                <a class="btn btn-link btn-block" href="{{ route('jobs.index') }}">Cancel</a>

            </form>
        </div>
    </div>
</div>

@endsection