<?php

namespace App\Http\Controllers;

use App\Models\ContactOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactOptionController extends Controller
{
    public function index()
    {

        $contacts = ContactOption::all();
        return view('admin.kontak', compact('contacts'));
    }
    public function SuperAdminindex()
    {
        $contacts = ContactOption::all();
        return view('superadmin.kontak', compact('contacts'));
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
        $route = Auth::user()->is_superadmin ? 'superadmin.kontak.index' : 'admin.kontak.index';
        return redirect()->back()->with('success', 'Contacts updated successfully!');
    }
}
