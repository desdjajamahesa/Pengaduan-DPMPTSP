<?php 

namespace App\Http\Controllers;

use App\Models\User;

class DashboardAdminController extends Controller 
{
  public function jumlah()
  {
    $userCount = User::count();
    return view ('admin.dasboard', compact('userCount'));
  }
}