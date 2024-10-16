<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    $endUserCount = User::where('role', 'end_user')->count();
    return view('admin.dashboard', compact('endUserCount'));
  }
}