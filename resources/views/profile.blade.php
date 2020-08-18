@extends('layout')

@section('title', 'Profile | ' . auth()->user()->email)


@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">

            <div class="bg-white p-5 shadow rounded">
            
                <h1 class="text-primary display-4 mb-0">Personal Info</h1>
                <hr>
                <h4 class="display-5 mb-1">Name: @if (Auth::user()->email=='admin@techie.com')
                                                {{ auth()->user()->first_name }}
                                           @else
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                           @endif  </h4>
                <p class="display-5 mb-1">Email: {{ auth()->user()->email }}</p>
                <p class="display-5 mb-1">Phone: {{ auth()->user()->phone }}<p>

                    <form action="{{ route('profile.uploadCV') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                            <label for="answer">Description:</label>
                            <textarea class="form-control bg-light shadow-sm
                                        @error('description')
                                            is-invalid
                                        @else
                                            border-0
                                        @enderror" 
                                id="description" 
                                name="description"
                                placeholder="Please enter a description of you...">{{ old('description', auth()->user()->description) }}
                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>        
                            @enderror
                        </div>
                    @if (auth()->user()->completed =='yes')
                    <div class="form-group embed-responsive embed-responsive-1by1">
                        <label>Your already uploaded your CV.</label>
                        <embed src="{{URL::asset(auth()->user()->curriculum)}}" class="embed-responsive-item"/>
                      </div>
                    <div class="form-group">
                        <label>Upload a new CV:</label>
                        <input type="file" class="form-control-file" name="curriculum" id="curriculum" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid file. Size of file should not be more than 2MB.</small>
                      </div>
                    @else
                    <div class="form-group">
                    <label>Please upload your CV:</label>
                        <input type="file" class="form-control-file" name="curriculum" id="curriculum" aria-describedby="fileHelp" required>
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid file. Size of file should not be more than 2MB.</small>
                      </div>
                    @endif  
                    <div class="form-group d-none">
                            <input class="form-control bg-light shadow-sm" 
                            id="completed" 
                            name="completed"
                            value="yes"
                            >
                        </div>   
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    <a class="btn btn-link btn-block" href="{{ route('home') }}">Cancel</a>
                    </form>
                
            </div>
        </div>
    </div> 
</div> 

@endsection