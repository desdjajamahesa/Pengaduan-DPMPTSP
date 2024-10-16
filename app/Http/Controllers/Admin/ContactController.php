<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactOption;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
    {
        $contacts = ContactOption::all(); // Memanggil Kontak
        return view('admin.kontak', compact('contacts'));
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