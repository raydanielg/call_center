<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('agent.contacts.index', compact('contacts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $contacts = Contact::where('name', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->latest()
            ->paginate(15);

        return view('agent.contacts.index', compact('contacts', 'query'));
    }
}
