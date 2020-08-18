@extends('layout')

@section('title', 'Message of '. $contact->name)

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">
        @if ($contact->replied<>'yes')
            <h2 class="bg-light text-center text-black-50 py-3 shadow">Please enter an answer for this request.</h2>
        @endif
            <div class="bg-white p-5 shadow rounded">
                <h2 class="display-5 mb-1">{{ $contact->name }}</h2>
                <h3 class="display-5 mb-1 mb-4">{{ $contact->email }}</h3>
                    @if ($contact->replied =='yes')
                        <p>{{ 'Requested on ' . $contact->created_at->subHours(5)->format('d/m/Y') . ' at ' . $contact->created_at->subHours(5) ->format('h:i a') }}</p>
                        <p>{{ 'Replied on ' . $contact->updated_at->subHours(5)->format('d/m/Y') . ' at ' . $contact->updated_at->subHours(5) ->format('h:i a') }}</p>
                    @else
                        @if ($contact->created_at->diffInHours() > 24)
                        <p class="bg-danger text-light">{{ 'Requested on ' . $contact->created_at->subHours(5)->format('d/m/Y') . ' at ' . $contact->created_at->subHours(5) ->format('h:i a') }}</p>        
                        @endif
                    @endif
              
                <p><span>Subject: </span><span class="text-black-50">{{ $contact->subject }}</span></p>
                <p><span>Content: </span><span class="text-black-50">{{ $contact->content }}</span></p>
                @if ($contact->replied<>'yes')
                    <form class="py-4"
                        method="POST" 
                        action="{{ route('contacts.update', $contact) }}"
                    >
                        @csrf @method('PATCH')
                        <div class="form-group">
                            <label for="answer">Answer:</label>
                            <textarea class="form-control bg-light shadow-sm
                                        @error('answer')
                                            is-invalid
                                        @else
                                            border-0
                                        @enderror" 
                                id="answer" 
                                name="answer"
                                placeholder="Please enter the answer for the request...">{{ old('answer') }}
                            </textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>        
                            @enderror
                        </div>
                        <div class="form-group d-none">
                            <input class="form-control bg-light shadow-sm" 
                            id="replied" 
                            name="replied"
                            value="yes"
                            >
                        </div>                
                        <button class="btn btn-primary btn-lg btn-block">Reply</button>
                        <a class="btn btn-link btn-block" href="{{ route('contacts.index') }}">Cancel</a>
                </form> 
            @else
                <p><span>Answer: </span><span class="text-black-50">{{ $contact->answer }}</span></p>
                <a class="btn btn-link btn-block" href="{{ route('contacts.index') }}">Back</a>
            @endif       
            </div>
        </div>
    </div> 
</div> 

@endsection