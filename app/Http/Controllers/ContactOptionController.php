<?php

namespace App\Http\Controllers;

use App\Models\ContactOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactOptionController extends Controller
{
    public function index()
    {
        $contacts = ContactOption::all(); // Fetch contacts from the database
        return view('admin.kontak', compact('contacts'));
    }

    public function SuperAdminindex()
    {
        $contacts = ContactOption::all(); // Fetch contacts for superadmin
        return view('superadmin.kontak', compact('contacts')); // Pass $contacts to the view
    }

    public function update(Request $request)
    {
        $request->validate([
            'contacts.*.type' => 'required|string',
            'contacts.*.value' => 'required|string',
        ]);

        foreach ($request->contacts as $contact) {
            ContactOption::updateOrCreate(['type' => $contact['type']], ['value' => $contact['value']]);
        }

        return redirect()->back()->with('success', 'Contacts updated successfully!');
    }
}
