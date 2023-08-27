<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Contact;
use App\Models\Countries;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View {
        
        $contacts = Contact::with('countries')->get();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);


        /*
            All
                Contact::all()

            Limit 10
                Contact::take(10)->get()

            Get books of year 2001
                Contact::where('country_id', 1)->get()

        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        
        $countries = Countries::all();
        return view('contacts.create', [
            'countries' => $countries
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'city' => $request->get('city'),
            'country_id' => $request->get('countries')
        ]);

        $contact->save();

        return to_route('contacts.index')
            ->with('status', 'Contact saved successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View {

        $contact = Contact::with('countries')->findOrFail($id);

        return view('contacts.show', [
            'contact' => $contact
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View {

        $contact = Contact::findOrFail($id);
        $countries = Countries::all();

        //dd($contact, $countries); Debug & Die
        
        return view('contacts.edit', [
            'contact' => $contact,
            'countries' => $countries
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse {

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $contact = Contact::find($id);
        $contact->first_name = $request->get('first_name');
        $contact->last_name  = $request->get('last_name');
        $contact->email      = $request->get('email');
        $contact->job_title  = $request->get('job_title');
        $contact->city       = $request->get('city');
        $contact->country_id = $request->get('countries');
        $contact->save();

        return to_route('contacts.index')
            ->with('success', 'Contact updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse {

        // Check if the user has the admin role
        if (auth()->user()->type !== 'admin') {
            return to_route('contacts.index')
            ->with('failed', 'Delete Unauthorized');
        }

        $contact = Contact::find($id);
        $contact->delete();

        return to_route('contacts.index')
            ->with('success', 'Contact deleted successfully');

    }

}
