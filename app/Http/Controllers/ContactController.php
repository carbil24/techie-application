<?php

namespace App\Http\Controllers;

use App\Contact;


use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;


use App\Http\Requests\SaveContactRequest; //imported
use App\Http\Requests\SaveRepliedRequest; //imported


class ContactController extends Controller
{
    public function index()
    {
        //$portfolio = Project::orderBy('created_at', 'DESC')->get();
        //$portfolio = Project::latest()->get();

        if (Auth::user()->email=='admin@techie.com'){
            $contacts = Contact::latest()->paginate();
            return view('contacts.indexContact', compact('contacts'));
        }
        else
            return redirect()->route('home');
    }

    public function create()
    {
        return view('contacts.createContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveContactRequest $request)
    {

        Contact::create($request->validated());

        return redirect()->route('home')->with('status', 'Thank you '.$request->name .'! Your request has been sent and we will answer you within the next 24 hours.');
    }

    public function update(Contact $contact, SaveRepliedRequest $request)
    {
        $contact->update($request->validated());


        return redirect()->route('contacts.index')->with('status', 'The request of '.$contact->name .' has been replied.');
    }


    
    /**
     * Show the specific contact.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showContactRequest(Contact $contact)
    {
        
        return view('contacts.showContactRequest', compact('contact'));
    }

        
    /**
     * Delete a contact request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('status', 'The message from '.$contact->name .' was deleted successfuly.');
    }
}
