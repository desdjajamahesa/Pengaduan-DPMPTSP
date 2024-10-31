<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pelaporan;

class PelaporanController extends Controller
{
  public function index()
  {
    return view('pelaporan');
  }
}