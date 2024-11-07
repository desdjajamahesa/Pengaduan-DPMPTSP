<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\Pengaduan;

class PelaporanController extends Controller
{
  public function index()
  {
      // Fetch pengaduan data (assuming you have a Pengaduan model)
      $pengaduans = Pengaduan::all();  // Or use a more specific query as needed
  
      // Pass the data to the view
      return view('pelaporan', compact('pengaduans'));
  }

  public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'status' => 'required|string',
        // Add other validation rules as needed
    ]);

    // Create a new Pelaporan entry
    Pelaporan::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'status' => $request->status,
        // Add other fields as necessary
    ]);

    return redirect()->route('pelaporan.index')->with('success', 'Pelaporan berhasil disubmit!');
}
}