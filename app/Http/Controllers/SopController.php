<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SopController extends Controller
{
    // Menampilkan halaman kelola SOP untuk Admin/Superadmin
    public function index(Request $request)
    {
        $query = Sop::query();

        // Search functionality (optional)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('image_url', 'like', "%{$search}%");
        }

        $sops = $query->paginate(10); // Ambil data SOP dengan pagination

        // Pilih view sesuai dengan peran pengguna

        return view('admin.sop', compact('sops'));
    }

    public function SuperAdminindex(Request $request)
    {
        $query = Sop::query();

        // Search functionality (optional)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('image_url', 'like', "%{$search}%");
        }

        $sops = $query->paginate(10); // Ambil data SOP dengan pagination

        // Pilih view sesuai dengan peran pengguna
        return view('superadmin.sop', compact('sops'));
    }

    // Menyimpan SOP baru untuk Admin/Superadmin
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar ke storage
        $path = $request->file('image')->store('sop_images', 'public');

        // Menyimpan data ke database
        Sop::create([
            'image_url' => $path,
        ]);

        // Redirection berdasarkan peran pengguna
        $route = Auth::user()->is_superadmin ? 'superadmin.sop.SuperAdminindex' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil ditambahkan!');
    }

    // Menampilkan form edit SOP untuk Admin/Superadmin
    public function edit($id)
    {
        $sop = Sop::findOrFail($id);

        // Pilih view sesuai dengan peran pengguna
        $view = Auth::user()->is_superadmin ? 'superadmin.edit-sop' : 'admin.edit-sop';
        return view($view, compact('sop'));
    }

    // Update SOP untuk Admin/Superadmin
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sop = Sop::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        // Simpan gambar baru ke storage
        $path = $request->file('image')->store('sop_images', 'public');

        // Update data di database
        $sop->update(['image_url' => $path]);

        // Redirection berdasarkan peran pengguna
        $route = Auth::user()->is_superadmin ? 'superadmin.sop.index' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil diupdate!');
    }

    // Hapus SOP untuk Admin/Superadmin
    public function destroy($id)
    {
        $sop = Sop::findOrFail($id);

        // Hapus gambar dari storage
        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        // Hapus data dari database
        $sop->delete();

        // Redirection berdasarkan peran pengguna
        $route = Auth::user()->is_superadmin ? 'superadmin.sop.index' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil dihapus!');
    }
}
