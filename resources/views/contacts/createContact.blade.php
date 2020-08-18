@extends('layout')

@section('title', 'Contact')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4"
                method="POST" 
                action="{{ route('contacts.store') }}"
            >
                @csrf
                <h1 class="text-primary display-4">Contact</h1>
                <hr>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control bg-light shadow-sm
                                @error('name')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="name" 
                        name="name"
                        placeholder="Please enter your name..." 
                        value="@auth{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}@else{{ old('name') }}@endauth"
                    >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                    <!--{!! $errors->first('name', '<small>:message</small><br/>') !!} -->
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control bg-light shadow-sm
                                @error('email')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="email" 
                        name="email"
                        placeholder="Please enter your email address..." 
                        value="@auth{{ auth()->user()->email }}@else{{ old('email') }}@endauth"
                    >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input class="form-control bg-light shadow-sm
                                @error('subject')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="subject" 
                        name="subject"
                        placeholder="Please enter the subject of your message..." 
                        value="{{ old('subject') }}"
                    >
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control bg-light shadow-sm
                                @error('content')
                                    is-invalid
                                @else
                                    border-0
                                @enderror" 
                        id="content" 
                        name="content"
                        placeholder="Please enter the content of your message...">{{ old('content') }}
                    </textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>        
                    @enderror
                </div>
                <div class="form-group d-none">
                    <input class="form-control bg-light shadow-sm" 
                        id="isUser" 
                        name="isUser"
                        value="@guest{{ 'no' }}@else{{ 'yes' }}@endguest"
                    >
                </div>
                <button class="btn btn-primary btn-lg btn-block">Send</button>
                <a class="btn btn-link btn-block" href="{{ route('home') }}">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection