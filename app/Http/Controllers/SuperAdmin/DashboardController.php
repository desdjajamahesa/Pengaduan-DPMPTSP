<?php 

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    return view('superadmin.dashboard');
  }
}