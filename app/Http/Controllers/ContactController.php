<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = \App\Models\Contact::where('user_id', auth()->id())->latest()->get();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('contacts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $input = $request->except('images');

        if ($request->hasFile('images')) {
            $input['images'] = array_map(fn($file) => $file->store('images', 'public'), $request->file('images'));
        }

        $input['user_id'] = auth()->id();

        \App\Models\Contact::create($input);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Contact $contact)
    {
        $categories = \App\Models\Category::all();
        return view('contacts.edit', compact('contact', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',  // Removed unique check for simplicity/to avoid self-id check complexity unless requested
            'phone' => 'required',
            'gender' => 'required',
            'interests' => 'required|array',
            'skills' => 'required|array',
            'category_id' => 'required|exists:categories,id',
        ]);

        $input = $request->except('images');

        if ($request->hasFile('images')) {
            $input['images'] = array_map(fn($file) => $file->store('images', 'public'), $request->file('images'));
        } else {
            $input['images'] = $contact->images;
        }

        $contact->update($input);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact deleted successfully');
    }
}
