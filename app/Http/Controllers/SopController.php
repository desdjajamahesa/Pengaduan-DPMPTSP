<?php

namespace App\Http\Controllers;

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

        if (Auth::user()->role === 'super_admin') {
            return view('superadmin.sop', compact('sops'));
        } else if (Auth::user()->role === 'admin') {
            return view('admin.sop', compact('sops'));
        }

        return abort(403, 'Unauthorized action.');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin') {
            return abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('sop_images', 'public');

        Sop::create([
            'image_url' => $path
        ]);

        $route = Auth::user()->role === 'super_admin' ? 'superadmin.sop.index' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin') {
            return abort(403, 'Unauthorized action.');
        }

        $sop = Sop::findOrFail($id);

        $view = Auth::user()->role === 'super_admin' ? 'superadmin.edit-sop' : 'admin.edit-sop';
        return view($view, compact('sop'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin') {
            return abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sop = Sop::findOrFail($id);

        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        $path = $request->file('image')->store('sop_images', 'public');
        $sop->update(['image_url' => $path]);

        $route = Auth::user()->role === 'super_admin' ? 'superadmin.sop.index' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'super_admin') {
            return abort(403, 'Unauthorized action.');
        }

        $sop = Sop::findOrFail($id);

        if ($sop->image_url && Storage::disk('public')->exists($sop->image_url)) {
            Storage::disk('public')->delete($sop->image_url);
        }

        $sop->delete();

        $route = Auth::user()->role === 'super_admin' ? 'superadmin.sop.index' : 'admin.sop.index';
        return redirect()->route($route)->with('success', 'SOP berhasil dihapus!');
    }
}
