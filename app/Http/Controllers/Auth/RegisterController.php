<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  use RegistersUsers;

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

      default:
        return '/';
        break;
    }
  }

  public function __construct()
  {
    $this->middleware('guest');
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'username' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'status' => ['required', 'string'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  protected function create(array $data)
  {
    return User::create([
      'username' => $data['username'],
      'email' => $data['email'],
      'status' => $data['status'],
      'password' => Hash::make($data['password']),
    ]);
  }
}
