<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sop;

class SopController extends Controller
{
    public function index(Request $request)
    {
        $query = Sop::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('image_url', 'like', "%{$search}%");
        }

        $sops = $query->paginate(10);
        
        return view('admin.sop', compact('sops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('sop_images', 'public');

        Sop::create([
            'image_url' => $path
        ]);

        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sop = Sop::findOrFail($id);

        return view('admin.edit-sop', compact('sop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sop = Sop::findOrFail($id);

        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        $path = $request->file('image')->store('sop_images', 'public');
        $sop->update(['image_url' => $path]);

        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil diupdate!');
    }

    public function destroy($id)
    {
        $sop = Sop::findOrFail($id);

        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        $sop->delete();

        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil dihapus!');
    }
}