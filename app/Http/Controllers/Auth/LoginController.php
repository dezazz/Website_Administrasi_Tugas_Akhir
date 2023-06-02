<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  public function redirectTo()
  {
    $role = Auth::user()->status;
    switch ($role) {
      case 'admin':
        return '/admin/dashboard';
        break;
      case 'mahasiswa':
        return '/mahasiswa/dashboard';
        break;
      case 'dosen_pembimbing':
        return '/dosen/dashboard';
        break;
      case 'prodi':
        return '/prodi/dashboard';
        break;
      case 'dosen_penguji':
        return '/penguji/dashboard';
        break;
      case 'kepala_laboratorium':
        return '/kepala_laboratorium/dashboard';
        break;
      case 'pegawai_prodi':
        return '/pegawai_prodi/dashboard';
        break;
      case 'sekretaris_prodi':
        return '/sekretaris_prodi/dashboard';
        break;
      case 'kepala_prodi':
        return '/kepala_prodi/dashboard';
        break;

      default:
        return '/';
        break;
    }
  }

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
}
