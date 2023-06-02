<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

  use ConfirmsPasswords;

  /**
   * Where to redirect users when the intended url fails.
   *
   * @var string
   */
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
      case 'kaprodi':
        return '/kaprodi/dashboard';
        break;
      case 'dosen_penguji':
        return '/penguji/dashboard';
        break;

      default:
        return '/';
        break;
    }
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
}
