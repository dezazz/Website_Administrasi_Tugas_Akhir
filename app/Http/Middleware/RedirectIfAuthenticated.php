<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
   public function handle($request, Closure $next, $guard = null)
   {
      if (Auth::guard($guard)->check()) {
         $role = Auth::user()->status;

         switch ($role) {
            case 'admin':
               return redirect('/admin/dashboard');
               break;
            case 'mahasiswa':
               return redirect('/mahasiswa/dashboard');
               break;
            case 'dosen_pembimbing':
               return redirect('/dosen/dashboard');
               break;
            case 'prodi':
               return redirect('/prodi/dashboard');
               break;
            case 'dosen_penguji':
               return redirect('/penguji/dashboard');
               break;
            case 'kepala_laboratorium':
               return redirect('/kepala_laboratorium/dashboard');
               break;
            case 'pegawai_prodi':
               return redirect('/pegawai_prodi/dashboard');
               break;
            case 'sekretaris_prodi':
               return redirect('/sekretaris_prodi/dashboard');
               break;
            case 'kepala_prodi':
               return redirect('/kepala_prodi/dashboard');
               break;

            default:
               return redirect('/');
               break;
         }
      }
      return $next($request);
   }
}
