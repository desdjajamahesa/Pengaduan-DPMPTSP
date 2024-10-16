<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
  public function showUser()
  {
    $endUserOnly = User::where('role', 'end_user')->count();
    
    $filter = User::where('role', 'end_user');

    $users = $filter->paginate(10);
    return view('admin.user', compact('endUserOnly', 'users'));
  }
}