<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function showContacts(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'instagram' => 'required',
            'map'=>'required',
        ]);
        $contacts = new Contact;
        $contacts->address = $request->input('address');
        $contacts->phone = $request->input('phone');
        $contacts->email = $request->input('email');
        $contacts->instagram = $request->input('instagram');
        $contacts->map= $request->input('map');

        $contacts->save();

        return redirect()->route('admin.contacts')->with('success', 'Contact information added!');
    }


    public function edit(Contact $contact){
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'instagram' => 'required',
            'map' => 'required|string',
        ]);

        $contact->update([
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'instagram' => $request->input('instagram'),
            'map' => $request->input('map'),
        ]);

        return redirect()->route('admin.contacts')->with('success', 'Contact information updated!');
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();
        $contact->delete();

        return redirect()->route('admin.contacts')->with('success', 'Contact deleted successfully!');
    }


}
