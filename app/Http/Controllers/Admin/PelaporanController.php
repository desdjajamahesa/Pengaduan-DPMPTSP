<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\Pengaduan;

class PelaporanController extends Controller
{
    public function showUser()
    {
      $endUserOnly = User::where('role', 'end_user')->count();
      $filter = User::where('role', 'end_user');
      $users = $filter->paginate(10);
  
      return view('admin.user', compact('endUserOnly', 'users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|string',
        ]);
        Pelaporan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
        ]);
        return redirect()->route('pelaporan.index')->with('success', 'Pelaporan berhasil disubmit!');
    }
    
}