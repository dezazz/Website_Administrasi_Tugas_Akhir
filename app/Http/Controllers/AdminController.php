<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;;

use App\Models\Skripsi;
use App\Models\NilaiIPK;
use App\Models\Mahasiswa;
use App\Models\BidangIlmu;
use App\Models\NilaiSemhas;
use App\Models\StatusAkses;
use App\Models\DosenPenguji;
use App\Models\JadwalSemhas;
use App\Models\JadwalSempro;
use App\Models\JadwalSidang;
use App\Models\PegawaiProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DosenPembimbing;
use App\Models\NilaiUjiProgram;
use App\Models\LogMahasiswaLulus;
use App\Models\NilaiSeminarHasil;
use App\Models\NilaiUjiKelayakan;
use App\Models\KepalaLaboratorium;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogPenambahanDosbing;
use App\Models\LogPengubahanDosbing;
use App\Models\LogPengubahanSkripsi;

use App\Models\NilaiSidangMejaHijau;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LogPendaftaranSkripsi;
use App\Models\LogPenghapusanDosbing;
use App\Models\LogPenghapusanSkripsi;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin/dashboard');
    }

    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* MANAJEMEN USER */
    public function manage_user()
    {
        return view('admin/manage_user');
    }

    // 1.Manajemen admin

    public function manajemen_admin()
    {
        $admins = Admin::select('id', 'id_user', 'nama', 'status')->latest()->paginate(10);
        return view('admin/manage_admin', compact('admins'));
    }

    public function add_admin()
    {
        return view('admin/add_admin');
    }

    public function store_admin(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8',
            'email'     => 'required|email|min:8|unique:users',
            'nama'      => 'required|min:8|regex:/^[a-zA-Z\s]*$/',
            'status'    => 'required',
        ]);

        // store admin account
        $admin_acc           = new User;
        $admin_acc->username = $request->username;
        $admin_acc->email    = $request->email;
        $admin_acc->status   = 'admin';
        $admin_acc->password = Hash::make($request->pw);
        $admin_acc->save();

        $adm = new Admin;
        $adm->nama = $request->nama;
        $adm->status = $request->status;
        $adm->id_user = $admin_acc->id;
        $adm->save();

        return redirect('/admin/manajemen_admin')->with('status', 'Data dosen berhasil ditambahkan!');
    }

    public function edit_admin(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $admin = Admin::where('id', $request->id)
            ->select('id', 'nama', 'status', 'id_user')
            ->first();
        return view('admin/edit_admin', compact('admin'));
    }

    public function store_upd_admin(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|regex:/^[a-zA-Z\s]*$/',
            'status'       => 'required',
        ]);

        Admin::where('id', $request->id)->update([
            'nama'            => $request->nama,
            'status'          => $request->status,
        ]);

        return redirect('/admin/manajemen_admin')->with('status', 'Perubahan berhasil disimpan!');
    }

    public function delete_adm(Request $request)
    {
        Admin::where('id_user', $request->id)->delete();
        $account = User::where('id', $request->id)->delete();
        return redirect('/admin/manajemen_admin')->with('status', 'Data admin telah dihapus!');
    }


    //2. Manajemen Dosen
    public function manajemen_dosen()
    {
        $dosens = DB::table('dosens as d')
            ->join('users as u', 'd.id_user', '=', 'u.id')
            ->select('d.nama', 'd.nip', 'd.nidn', 'd.kode')
            ->where('u.status', 'dosen')
            ->orderBy('nip')
            ->paginate(25);

        return view('admin/manage_dosen', compact('dosens'));
    }
    public function manajemen_kepala_lab()
    {
        $dosens = DB::table('dosens as d')
            ->join('users as u', 'd.id_user', '=', 'u.id')
            ->join('kepala_laboratoriums as k', 'd.nip', '=', 'k.nip')
            ->join('bidang_ilmus as b', 'k.id_bidang_ilmu', '=', 'b.id')
            ->select('d.nama', 'd.nip', 'd.nidn', 'd.kode', 'b.bidang_ilmu')
            ->where('u.status', 'kepala_laboratorium')
            ->orderBy('nip')
            ->paginate(25);

        return view('admin/manage_kepala_laboratorium', compact('dosens'));
    }

    public function add_dosen()
    {
        return view('admin/add_dosen');
    }
    public function add_kepala_lab()
    {
        $bidang_ilmu = BidangIlmu::all();
        return view('admin/add_kepala_laboratorium', compact('bidang_ilmu'));
    }

    public function store_dosen(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8|max:255',
            'email'     => 'required|email|min:8|max:255|unique:users',
            'nama'      => 'required|min:8|max:255',
            'nip'       => 'required|numeric|digits_between:18,18|unique:dosens',
            'nidn'      => 'required|numeric|digits_between:10,10|unique:dosens',
            'kode'      => 'required|min:3|max:5|unique:dosens',
            'sex'       => 'required'
        ]);

        $dosen_acc           = new User;
        $dosen_acc->username = $request->username;
        $dosen_acc->email    = $request->email;
        $dosen_acc->status   = 'dosen';
        $dosen_acc->password = Hash::make($request->pw);
        $dosen_acc->save();

        $dosen                  = new Dosen;
        $dosen->nama            = $request->nama;
        $dosen->nip             = $request->nip;
        $dosen->nidn            = $request->nidn;
        $dosen->kode            = $request->kode;
        $dosen->jenis_kelamin   = $request->sex;
        $dosen->id_user         = $dosen_acc->id;
        $dosen->save();

        return redirect('/admin/manajemen_dosen')->with('status', 'Data dosen berhasil ditambahkan!');
    }
    public function store_kepala_lab(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8|max:255',
            'email'     => 'required|email|min:8|max:255|unique:users',
            'nama'      => 'required|min:8|max:255',
            'nip'       => 'required|numeric|digits_between:18,18|unique:dosens',
            'nidn'      => 'required|numeric|digits_between:10,10|unique:dosens',
            'kode'      => 'required',
            'sex'       => 'required'
        ]);

        $kepala_lab          = new KepalaLaboratorium;
        $kepala_lab->nip = $request->nip;
        $kepala_lab->id_bidang_ilmu = $request->kode;
        $kepala_lab->save();


        $dosen_acc           = new User;
        $dosen_acc->username = $request->username;
        $dosen_acc->email    = $request->email;
        $dosen_acc->status   = 'dosen';
        $dosen_acc->password = Hash::make($request->pw);
        $dosen_acc->save();

        $dosen                  = new Dosen;
        $dosen->nama            = $request->nama;
        $dosen->nip             = $request->nip;
        $dosen->nidn            = $request->nidn;
        $dosen->kode            = $request->kode;
        $dosen->jenis_kelamin   = $request->sex;
        $dosen->id_user         = $dosen_acc->id;
        $dosen->save();

        return redirect('/admin/manajemen_dosen')->with('status', 'Data Kepala Laboratorium berhasil ditambahkan!');
    }

    public function edit_dosen(Request $request)
    {
        $dosen = Dosen::where('nip', $request->nip)
            ->join('kepala_laboratoriums as k', 'dosens.nip', '=', 'k.nip')
            ->join('bidang_ilmus as b', 'k.id_bidang_ilmu', '=', 'b.id')
            ->select('nama', 'nip', 'nidn', 'kode', 'jenis_kelamin', 'b.bidang_ilmu')
            ->first();

        return view('admin/edit_dosen', compact('dosen'));
    }
    public function edit_kepala_lab(Request $request)
    {
        $dosen = Dosen::where('nip', $request->nip)
            ->select('nama', 'nip', 'nidn', 'kode', 'jenis_kelamin')
            ->first();
        $bidang_ilmu = BidangIlmu::all();
        return view('admin/edit_kepala_lab', compact('dosen', 'bidang_ilmu'));
    }

    public function store_upd_dosen(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|max:255',
            'new_nip'       => 'required|numeric|digits_between:18,18',
            'new_nidn'      => 'required|numeric|digits_between:10,10',
            'new_kode'      => 'required|min:3|max:5',
            'sex'           => 'required',
        ]);

        if ($request->old_nip != $request->new_nip && Dosen::where('nip', $request->new_nip)->count() >= 1) {
            return redirect('/admin/manajemen_dosen')->with('prohibited', 'NIP tersebut sudah terdaftar!');
        } else if ($request->old_nidn != $request->new_nidn && Dosen::where('NIDN', $request->new_nidn)->count() >= 1) {
            return redirect('/admin/manajemen_dosen')->with('prohibited', 'NIDN tersebut sudah terdaftar!');
        } else {
            Dosen::where('nip', $request->old_nip)->update([
                'nama'          => $request->nama,
                'nip'           => $request->new_nip,
                'NIDN'          => $request->new_nidn,
                'kode'          => $request->new_kode,
                'jenis_kelamin' => $request->sex,
            ]);

            return redirect('/admin/manajemen_kepala_lab')->with('status', 'Perubahan berhasil disimpan!');
        }
    }
    public function store_upd_kepala_lab(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|max:255',
            'new_nip'       => 'required|numeric|digits_between:18,18',
            'new_nidn'      => 'required|numeric|digits_between:10,10',
            'sex'           => 'required',
        ]);

        if ($request->old_nip != $request->new_nip && Dosen::where('nip', $request->new_nip)->count() >= 1) {
            return redirect('/admin/manajemen_dosen')->with('prohibited', 'NIP tersebut sudah terdaftar!');
        } else if ($request->old_nidn != $request->new_nidn && Dosen::where('NIDN', $request->new_nidn)->count() >= 1) {
            return redirect('/admin/manajemen_dosen')->with('prohibited', 'NIDN tersebut sudah terdaftar!');
        } else {
            KepalaLaboratorium::where('nip', $request->old_nip)->update([
                'id_bidang_ilmu' => $request->new_kode,
            ]);
            Dosen::where('nip', $request->old_nip)->update([
                'nama'          => $request->nama,
                'nip'           => $request->new_nip,
                'NIDN'          => $request->new_nidn,
                'jenis_kelamin' => $request->sex,
            ]);

            return redirect('/admin/manajemen_kepala_lab')->with('status', 'Perubahan berhasil disimpan!');
        }
    }

    public function delete_dosen(Request $request)
    {
        $user_id = Dosen::where('nip', $request->nip)->select('id_user')->first();
        Dosen::where('nip', $request->nip)->delete();
        $account = User::where('id', $user_id)->delete();
        return redirect('/admin/manajemen_dosen')->with('status', 'Data dosen telah dihapus!');
    }
    public function delete_kepala_lab(Request $request)
    {
        $user_id = Dosen::where('nip', $request->nip)->select('id_user')->first();
        KepalaLaboratorium::where('nip', $request->nip)->delete();
        $account = User::where('id', $user_id)->delete();
        return redirect('/admin/manajemen_kepala_lab')->with('status', 'Data dosen telah dihapus!');
    }

    //3.  Manajemen Mahasiswa
    public function manajemen_mhs()
    {
        $mahasiswas = Mahasiswa::select('nama', 'nim', 'status')->where('status', 'aktif')->paginate(10);
        return view('admin/manage_mhs', compact('mahasiswas'));
    }

    public function add_mhs()
    {
        return view('admin/add_mhs');
    }

    public function store_mhs(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:3|max:255',
            'pw'        => 'required|min:8',
            'email'     => 'required|email|min:8|unique:users',
            'nama'      => 'required|min:8|regex:/^[a-zA-Z\s]*$/',
            'nim'       => 'required|numeric|digits_between:9,9|unique:mahasiswas',
            'angkatan'  => 'required|min:4|max:4',
            'sex'       => 'required'
        ]);

        // store mahasiswa account
        $mhs_account           = new User;
        $mhs_account->username = $request->username;
        $mhs_account->email    = $request->email;
        $mhs_account->status   = 'mahasiswa';
        $mhs_account->password = Hash::make($request->pw);
        $mhs_account->save();

        $mhs = new Mahasiswa;
        $mhs->nim = $request->nim;
        $mhs->nama = $request->nama;
        $mhs->angkatan = $request->angkatan;
        $mhs->jenis_kelamin = $request->sex;
        $mhs->status = 'Aktif';
        $mhs->id_user = $mhs_account->id;

        if ($request->hasFile('foto')) {

            $this->validate($request, [
                'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);

            // define lokasi foto
            $location = public_path('/main/photos');
            //menyimpan foto dengan nama original ke lokasi yang ditentukan
            $request->file('foto')->move($location, $request->file('foto')->getClientOriginalName());
            // menyimpan nama original file foto di db
            $mhs->foto = $request->file('foto')->getClientOriginalName();
            $mhs->save();
        } else {
            $mhs->foto = NULL;
            $mhs->save();
        }

        return redirect('/admin/manajemen_mhs')->with('status', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit_mhs(Request $request)
    {
        $mhs = Mahasiswa::where('nim', $request->nim)
            ->select('nim', 'angkatan', 'nama', 'jenis_kelamin', 'foto', 'status')
            ->first();
        return view('admin/edit_mhs', compact('mhs'));
    }

    public function store_upd_mhs(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|min:8|regex:/^[a-zA-Z\s]*$/',
            'new_nim'   => 'required|numeric|digits_between:9,9',
            'angkatan'  => 'required|min:4|max:4',
            'sex'       => 'required'
        ]);

        if ($request->old_nim == $request->new_nim) {

            $mhs = Mahasiswa::find($request->old_nim);
            Mahasiswa::where('nim', $request->old_nim)->update([
                'nama'            => $request->nama,
                'nim'             => $request->new_nim,
                'angkatan'        => $request->angkatan,
                'jenis_kelamin'   => $request->sex,
            ]);

            if ($request->old_foto != NULL) {
                if ($request->hasFile('foto')) {
                    //memeriksa validasi inputan file gambar
                    $this->validate($request, [
                        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
                    ]);

                    if (File::exists(public_path('main/photos/' . $request->old_foto))) {
                        File::delete(public_path('main/photos/' . $request->old_foto));
                    }

                    $location = public_path('/main/photos');
                    $request->file('foto')->move($location, $request->file('foto')->getClientOriginalName());
                    $mhs->foto = $request->file('foto')->getClientOriginalName();
                    $mhs->save();
                }
            } else {
                if ($request->hasFile('foto')) {
                    //memeriksa validasi inputan file gambar
                    $this->validate($request, [
                        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
                    ]);

                    $location = public_path('/main/photos');
                    $request->file('foto')->move($location, $request->file('foto')->getClientOriginalName());
                    $mhs->foto = $request->file('foto')->getClientOriginalName();
                    $mhs->save();
                }
            }
            return redirect('/admin/manajemen_mhs')->with('status', 'Perubahan berhasil disimpan!');
        } else {
            if (Mahasiswa::where('nim', $request->new_nim)->count() >= 1) {
                return redirect('/admin/manajemen_mhs')->with('prohibited', 'Mahasiswa dengan NIM tersebut sudah terdaftar!');
            } else {
                $mhs = Mahasiswa::find($request->old_nim);
                Mahasiswa::where('nim', $request->old_nim)->update([
                    'nama'            => $request->nama,
                    'nim'             => $request->new_nim,
                    'angkatan'        => $request->angkatan,
                    'jenis_kelamin'   => $request->sex,
                ]);


                if ($old_foto != NULL) {
                    if ($request->hasFile('foto')) {
                        //memeriksa validasi inputan file gambar
                        $this->validate($request, [
                            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
                        ]);

                        if (File::exists(public_path('main/photos/' . $request->old_foto))) {
                            File::delete(public_path('main/photos/' . $request->old_foto));
                        }

                        $location = public_path('/main/photos');
                        $request->file('foto')->move($location, $request->file('foto')->getClientOriginalName());
                        $mhs->foto = $request->file('foto')->getClientOriginalName();
                        $mhs->save();
                    } else {
                        $mhs->foto = $request->old_foto;
                        $mhs->save();
                    }
                } else {
                    if ($request->hasFile('foto')) {
                        //memeriksa validasi inputan file gambar
                        $this->validate($request, [
                            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
                        ]);

                        $location = public_path('/main/photos');
                        $request->file('foto')->move($location, $request->file('foto')->getClientOriginalName());
                        $mhs->foto = $request->file('foto')->getClientOriginalName();
                        $mhs->save();
                    } else {
                        $mhs->foto = $request->old_foto;
                        $mhs->save();
                    }
                }
                return redirect('/admin/manajemen_mhs')->with('status', 'Perubahan berhasil disimpan!');
            }
        }
    }

    public function delete_mhs(Request $request)
    {
        $access_right = StatusAkses::where('nim', $request->nim)->delete();
        $mhs = Mahasiswa::where('nim', $request->nim)->select('id_user', 'foto')->first();
        if (File::exists(public_path('main/photos/' . $mhs->foto))) {
            File::delete(public_path('main/photos/' . $mhs->foto));
        }
        $account = User::where('id', $mhs->id_user)->delete();
        Mahasiswa::where('nim', $request->nim)->delete();
        return redirect('/admin/manajemen_mhs')->with('status', 'Data mahasiswa telah dihapus!');
    }

    //4. Manajemen Prodi
    public function manajemen_prodi()
    {
        $prodis = DB::table('pegawai_prodis as d')
            ->join('users as u', 'd.id_user', '=', 'u.id')
            ->select('d.nip', 'd.nama')
            ->where('u.status', 'pegawai_prodi')
            ->orderBy('nip')
            ->paginate(25);

        return view('admin.manage_prodi', compact('prodis'));
    }

    public function manajemen_kaprodi()
    {
        $prodis = DB::table('dosens as d')
            ->join('users as u', 'd.id_user', '=', 'u.id')
            ->select('d.nip', 'd.nama', 'd.NIDN', 'd.kode')
            ->where('u.status', 'kepala_prodi')
            ->orderBy('nip')
            ->paginate(25);

        return view('admin.manage_kaprodi', compact('prodis'));
    }
    public function manajemen_sekretaris_prodi()
    {
        $prodis = DB::table('dosens as d')
            ->join('users as u', 'd.id_user', '=', 'u.id')
            ->select('d.nip', 'd.nama', 'd.NIDN', 'd.kode')
            ->where('u.status', 'sekretaris_prodi')
            ->orderBy('nip')
            ->paginate(25);

        return view('admin.manage_sekretaris_prodi', compact('prodis'));
    }

    public function add_prodi()
    {
        return view('admin.add_prodi');
    }
    public function add_kaprodi()
    {
        return view('admin.add_prodi');
    }
    public function add_sekretaris_prodi()
    {
        return view('admin.add_prodi');
    }

    public function store_prodi(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8|max:255',
            'email'     => 'required|email|min:8|max:255|unique:users',
            'nama'      => 'required|min:8|max:255',
            'nip'       => 'required|numeric|digits_between:18,18|unique:dosens',
            'sex'       => 'required'
        ]);

        $dosen_acc           = new User;
        $dosen_acc->username = $request->username;
        $dosen_acc->email    = $request->email;
        $dosen_acc->status   = 'pegawai_prodi';
        $dosen_acc->password = Hash::make($request->pw);
        $dosen_acc->save();

        $dosen                  = new PegawaiProdi;
        $dosen->nama            = $request->nama;
        $dosen->nip             = $request->nip;
        $dosen->jenis_kelamin   = $request->sex;
        $dosen->id_user         = $dosen_acc->id;
        $dosen->save();

        return redirect('/admin/manajemen_prodi')->with('status', 'Data pegawai prodi berhasil ditambahkan!');
    }
    public function store_sekretaris_prodi(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8|max:255',
            'email'     => 'required|email|min:8|max:255|unique:users',
            'nama'      => 'required|min:8|max:255',
            'nip'       => 'required|numeric|digits_between:18,18|unique:dosens',
            'nidn'      => 'required|numeric|digits_between:10,10|unique:dosens',
            'kode'      => 'required|min:3|max:5|unique:dosens',
            'sex'       => 'required'
        ]);

        $dosen_acc           = new User;
        $dosen_acc->username = $request->username;
        $dosen_acc->email    = $request->email;
        $dosen_acc->status   = 'sekretaris_prodi';
        $dosen_acc->password = Hash::make($request->pw);
        $dosen_acc->save();

        $dosen                  = new Dosen;
        $dosen->nama            = $request->nama;
        $dosen->nip             = $request->nip;
        $dosen->nidn            = $request->nidn;
        $dosen->kode            = $request->kode;
        $dosen->jenis_kelamin   = $request->sex;
        $dosen->id_user         = $dosen_acc->id;
        $dosen->save();

        return redirect('/admin/manajemen_sekretaris_prodi')->with('status', 'Data Sekretaris Program Studi berhasil ditambahkan!');
    }
    public function store_kaprodi(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|min:5|max:255',
            'pw'        => 'required|min:8|max:255',
            'email'     => 'required|email|min:8|max:255|unique:users',
            'nama'      => 'required|min:8|max:255',
            'nip'       => 'required|numeric|digits_between:18,18|unique:dosens',
            'nidn'      => 'required|numeric|digits_between:10,10|unique:dosens',
            'kode'      => 'required|min:3|max:5|unique:dosens',
            'sex'       => 'required'
        ]);

        $dosen_acc           = new User;
        $dosen_acc->username = $request->username;
        $dosen_acc->email    = $request->email;
        $dosen_acc->status   = 'kepala_prodi';
        $dosen_acc->password = Hash::make($request->pw);
        $dosen_acc->save();

        $dosen                  = new Dosen;
        $dosen->nama            = $request->nama;
        $dosen->nip             = $request->nip;
        $dosen->nidn            = $request->nidn;
        $dosen->kode            = $request->kode;
        $dosen->jenis_kelamin   = $request->sex;
        $dosen->id_user         = $dosen_acc->id;
        $dosen->save();

        return redirect('/admin/manajemen_kaprodi')->with('status', 'Data Kepala Program Studi berhasil ditambahkan!');
    }

    public function edit_prodi(Request $request)
    {
        $prodi = PegawaiProdi::where('nip', $request->nip)
            ->select('nip', 'nama', 'jenis_kelamin')
            ->first();
        return view('admin/edit_prodi', compact('prodi'));
    }
    public function edit_kaprodi(Request $request)
    {
        $prodi = Dosen::where('nip', $request->nip)
            ->select('nip', 'nidn', 'kode', 'nama', 'jenis_kelamin')
            ->first();
        return view('admin/edit_kaprodi', compact('prodi'));
    }
    public function edit_sekretaris_prodi(Request $request)
    {
        $prodi = Dosen::where('nip', $request->nip)
            ->select('nip', 'nidn', 'kode', 'nama', 'jenis_kelamin')
            ->first();
        return view('admin/edit_sekretaris_prodi', compact('prodi'));
    }

    public function store_upd_prodi(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|max:255',
            'new_nip'       => 'required|numeric|digits_between:18,18',
            'sex'           => 'required',
        ]);


        if ($request->old_nip != $request->new_nip && PegawaiProdi::where('nip', $request->new_nip)->count() >= 1) {
            return redirect('/admin/manajemen_prodi')->with('prohibited', 'NIP tersebut sudah terdaftar!');
        } else {
            PegawaiProdi::where('nip', $request->old_nip)->update([
                'nama'          => $request->nama,
                'nip'           => $request->new_nip,
                'jenis_kelamin' => $request->sex,
            ]);

            return redirect('/admin/manajemen_prodi')->with('status', 'Perubahan berhasil disimpan!');
        }
    }
    public function store_upd_kaprodi(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|max:255',
            'new_nip'       => 'required|numeric|digits_between:18,18',
            'new_nidn'      => 'required|numeric|digits_between:10,10',
            'new_kode'      => 'required|min:3|max:5',
            'sex'           => 'required',
        ]);


        if ($request->old_nip != $request->new_nip && Dosen::where('nip', $request->new_nip)->count() >= 1) {
            return redirect('/admin/manajemen_kaprodi')->with('prohibited', 'NIP tersebut sudah terdaftar!');
        } else if ($request->old_nidn != $request->new_nidn && Dosen::where('NIDN', $request->new_nidn)->count() >= 1) {
            return redirect('/admin/manajemen_kaprodi')->with('prohibited', 'NIDN tersebut sudah terdaftar!');
        } else if ($request->old_kode != $request->new_kode && Dosen::where('kode', $request->new_kode)->count() >= 1) {
            return redirect('/admin/manajemen_kaprodi')->with('prohibited', 'Kode tersebut sudah terdaftar!');
        } else {
            Dosen::where('nip', $request->old_nip)->update([
                'nama'          => $request->nama,
                'nip'           => $request->new_nip,
                'NIDN'          => $request->new_nidn,
                'kode'          => $request->new_kode,
                'jenis_kelamin' => $request->sex,
            ]);

            return redirect('/admin/manajemen_kaprodi')->with('status', 'Perubahan berhasil disimpan!');
        }
    }
    public function store_upd_sekretaris_prodi(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|min:8|max:255',
            'new_nip'       => 'required|numeric|digits_between:18,18',
            'new_nidn'      => 'required|numeric|digits_between:10,10',
            'new_kode'      => 'required|min:3|max:5',
            'sex'           => 'required',
        ]);


        if ($request->old_nip != $request->new_nip && Dosen::where('nip', $request->new_nip)->count() >= 1) {
            return redirect('/admin/manajemen_sekretaris_prodi')->with('prohibited', 'NIP tersebut sudah terdaftar!');
        } else if ($request->old_nidn != $request->new_nidn && Dosen::where('NIDN', $request->new_nidn)->count() >= 1) {
            return redirect('/admin/manajemen_sekretaris_prodi')->with('prohibited', 'NIDN tersebut sudah terdaftar!');
        } else if ($request->old_kode != $request->new_kode && Dosen::where('kode', $request->new_kode)->count() >= 1) {
            return redirect('/admin/manajemen_sekretaris_prodi')->with('prohibited', 'Kode tersebut sudah terdaftar!');
        } else {
            Dosen::where('nip', $request->old_nip)->update([
                'nama'          => $request->nama,
                'nip'           => $request->new_nip,
                'NIDN'          => $request->new_nidn,
                'kode'          => $request->new_kode,
                'jenis_kelamin' => $request->sex,
            ]);

            return redirect('/admin/manajemen_sekretaris_prodi')->with('status', 'Perubahan berhasil disimpan!');
        }
    }

    public function delete_prodi(Request $request)
    {
        $user_id = PegawaiProdi::where('nip', $request->nip)->select('id_user')->first();
        // hapus akun
        User::where('id', $user_id)->delete();
        // hapus record PegawaiProdi
        PegawaiProdi::where('nip', $request->nip)->delete();
        return redirect('/admin/manajemen_prodi')->with('status', 'Data prodi telah dihapus!');
    }
    public function delete_kaprodi(Request $request)
    {
        $user_id = Dosen::where('nip', $request->nip)->select('id_user')->first();
        // hapus akun
        User::where('id', $user_id)->delete();
        // hapus record dosen
        Dosen::where('nip', $request->nip)->delete();
        return redirect('/admin/manajemen_kaprodi')->with('status', 'Data Kepala Program Studi telah dihapus!');
    }
    public function delete_sekretaris_prodi(Request $request)
    {
        $user_id = Dosen::where('nip', $request->nip)->select('id_user')->first();
        // hapus akun
        User::where('id', $user_id)->delete();
        // hapus record dosen
        Dosen::where('nip', $request->nip)->delete();
        return redirect('/admin/manajemen_sekretaris_prodi')->with('status', 'Data Sekretaris Program Studi telah dihapus!');
    }

    /* END MANAJEMEN USER */
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // PENJADWALAN

    public function penjadwalan()
    {
        return view('/admin/penjadwalan');
    }

    public function penjadwalan_sempro()
    {
        // mahasiswa yang bisa didaftarkan jadwalnya, harus udah punya dosen pembimbing. 
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sempros as js', 'm.nim', '=', 'js.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_sempro', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif')
            ->where('s.no_statusAkses', '=', 1)
            ->orWhere('s.no_statusAkses', '=', 2)
            ->orderBy('js.tanggal_sempro', 'DESC')
            ->paginate(12);

        $query = DB::table('jadwal_sempros')
            ->select('tanggal_sempro')
            ->distinct()->orderBy('tanggal_sempro', 'ASC')
            ->get();
        return view('admin/penjadwalan_sempro', compact('mahasiswas', 'query'));
    }

    public function penjadwalan_semhas()
    {
        $query = DB::table('jadwal_semhas')
            ->select('tanggal_semhas')
            ->distinct()->orderBy('tanggal_semhas', 'ASC')
            ->get();

        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_semhas as js', 'm.nim', '=', 'js.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_semhas', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif')
            ->where('s.no_statusAkses', '=', 3)
            ->orWhere('s.no_statusAkses', '=', 4)
            ->orderBy('js.tanggal_semhas', 'DESC')
            ->paginate(10);
        return view('admin/penjadwalan_semhas', compact('mahasiswas', 'query'));
    }

    public function penjadwalan_sidang()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sidangs as js', 'm.nim', '=', 'js.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_sidang', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif')
            ->where('s.no_statusAkses', '=', 5)
            ->orWhere('s.no_statusAkses', '=', 6)
            ->orderBy('js.tanggal_sidang', 'DESC')
            ->paginate(10);
        $query = DB::table('jadwal_sidangs')
            ->select('tanggal_sidang')
            ->distinct()->orderBy('tanggal_sidang', 'ASC')
            ->get();
        return view('admin/penjadwalan_sidang', compact('mahasiswas', 'query'));
    }

    public function add_jd_sempro(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('admin/add_jd_sempro', compact('mahasiswa'));
    }

    public function add_jd_semhas(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('admin/add_jd_semhas', compact('mahasiswa'));
    }

    public function add_jd_sidang(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('admin/add_jd_sidang', compact('mahasiswa'));
    }

    public function store_jd_semhas(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:6|max:64'
        ]);

        $jadwal_semhas = new JadwalSemhas;
        $jadwal_semhas->nim = $request->nim;
        $jadwal_semhas->tanggal_semhas = $request->date;
        $jadwal_semhas->waktu = $request->waktu;
        $jadwal_semhas->tempat = $request->tempat;
        $jadwal_semhas->save();

        if (DosenPenguji::where('nim', $request->nim)->count() > 0) {
            DB::select("CALL tahapKeempat($request->nim)");
            return redirect('/admin/jadwal_semhas')->with('status', 'Jadwal Seminar Hasil berhasil ditambahkan');
        } else {
            return redirect('/admin/jadwal_semhas')->with('status', 'Jadwal Seminar Hasil berhasil ditambahkan');
        }
    }

    public function store_jd_sempro(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:6|max:64'
        ]);

        $jadwal_sempro = new JadwalSempro;
        $jadwal_sempro->nim = $request->nim;
        $jadwal_sempro->tanggal_sempro = $request->date;
        $jadwal_sempro->waktu = $request->waktu;
        $jadwal_sempro->tempat = $request->tempat;
        $jadwal_sempro->save();
        // mengubah status akses
        if ((Skripsi::where('nim', $request->nim)->count()) > 0) {
            DB::select("CALL tahapKedua($request->nim)");
            return redirect('/admin/jadwal_sempro')->with('status', 'Jadwal Seminar Proposal berhasil ditambahkan!');
        } else {
            return redirect('/admin/jadwal_sempro')->with('status', 'Jadwal Seminar Proposal berhasil ditambahkan! Daftarkan data skripsi agar mahasiswa dapat melanjutkan proses administrasi.');
        }
    }

    public function store_jd_sidang(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:10|max:64'
        ]);

        $nama = $request->nama;
        $jadwal_sidang = new JadwalSidang;
        $jadwal_sidang->nim = $request->nim;
        $jadwal_sidang->tanggal_sidang = $request->date;
        $jadwal_sidang->waktu = $request->waktu;
        $jadwal_sidang->tempat = $request->tempat;
        $jadwal_sidang->save();

        DB::select("CALL tahapKeenam($request->nim)");
        return redirect('/admin/jadwal_sidang')->with('status', 'Jadwal sidang berhasil ditambahkan!');
    }

    public function edit_jd_sempro(Request $request)
    {
        $nama = $request->nama;
        $jadwal = JadwalSempro::where('nim', $request->nim)->select('nim', 'tanggal_sempro', 'waktu', 'tempat')->first();
        return view('admin/edit_jd_sempro', compact('nama', 'jadwal'));
    }

    public function edit_jd_semhas(Request $request)
    {
        $nama = $request->nama;
        $jadwal = JadwalSemhas::where('nim', $request->nim)->select('nim', 'tanggal_semhas', 'waktu', 'tempat')->first();
        return view('admin/edit_jd_semhas', compact('nama', 'jadwal'));
    }

    public function edit_jd_sidang(Request $request)
    {
        $nama = $request->nama;
        $jadwal = JadwalSidang::where('nim', $request->nim)->select('nim', 'tanggal_sidang', 'waktu', 'tempat')->first();
        return view('admin/edit_jd_sidang', compact('nama', 'jadwal'));
    }

    public function store_new_jd_sempro(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:10|max:64'
        ]);

        JadwalSempro::where('nim', $request->nim)->update([
            'tanggal_sempro'  => $request->date,
            'waktu'           => $request->waktu,
            'tempat'          => $request->tempat,
        ]);

        return redirect('/admin/jadwal_sempro')->with('status', 'Jadwal seminar proposal berhasil diubah!');
    }

    public function store_new_jd_semhas(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:10|max:64'
        ]);

        JadwalSemhas::where('nim', $request->nim)->update([
            'tanggal_semhas'   => $request->date,
            'waktu'            => $request->waktu,
            'tempat'           => $request->tempat,
        ]);

        return redirect('/admin/jadwal_semhas')->with('status', 'Jadwal seminar hasil berhasil diubah!');
    }

    public function store_new_jd_sidang(Request $request)
    {
        $validated = $request->validate([
            'date'     => 'required',
            'waktu'    => 'required',
            'tempat'   => 'required|min:10|max:64'
        ]);
        JadwalSidang::where('nim', $request->nim)->update([
            'tanggal_sidang'    => $request->date,
            'waktu'             => $request->waktu,
            'tempat'            => $request->tempat,
        ]);
        return redirect('/admin/jadwal_sidang')->with('status', 'Jadwal sidang berhasil diubah!');
    }

    public function delete_jd_sempro(Request $request)
    {
        // mengubah status akses 
        DB::select("CALL tahapPertama($request->nim)");
        JadwalSempro::where('nim', $request->nim)->delete();
        return redirect('/admin/jadwal_sempro')->with('status', 'Jadwal seminar proposal berhasil dihapus!');
    }

    public function delete_jd_semhas(Request $request)
    {
        //ubah status akses
        DB::select("CALL tahapKetiga($request->nim)");
        JadwalSemhas::where('nim', $request->nim)->delete();
        return redirect('/admin/jadwal_semhas')->with('status', 'Jadwal seminar hasil berhasil dihapus!');
    }

    public function delete_jd_sidang(Request $request)
    {
        //ubah status akses
        DB::select("CALL tahapKelima($request->nim)");
        JadwalSidang::where('nim', $request->nim)->delete();
        return redirect('/admin/jadwal_sidang')->with('status', 'Jadwal sidang berhasil dihapus!');
    }

    // AKHIR PENJADWALAN 
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FUNGSI UNTUK MENU PRA SEMPRO

    public function page_pra_sempro()
    {
        return view('admin/pra_sempro');
    }

    // 1. doping
    public function list_dosbing()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('v_dosbing as db', 'm.nim', '=', 'db.nim')
            ->select('m.nama', 'm.nim', 'db.nip_dosbing1', 'db.nama_dosbing1', 'db.nip_dosbing2', 'db.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->orderBy('nim', 'ASC')
            ->paginate(20);
        return view('admin/daftar_dosbing', compact('mahasiswas'));
    }

    public function add_dosbing(Request $request)
    {
        $nim = $request->nim;
        $nama_mhs = $request->nama;
        $dosens = Dosen::select('nip', 'nama')->get();
        return view('admin/add_dosbing', compact('nim', 'nama_mhs', 'dosens'));
    }

    public function store_dosbing(Request $request)
    {
        $validated = $request->validate([
            'dosbing1'     => 'required',
            'dosbing2'     => 'required'
        ]);

        if ($request->dosbing1 != $request->dosbing2) {
            $dosbing = new DosenPembimbing;
            $dosbing->nim = $request->nim;
            $dosbing->nip_dosbing1 = $request->dosbing1;
            $dosbing->nip_dosbing2 = $request->dosbing2;
            $dosbing->save();

            // memasukkan data ke log_add_dosbings
            $log = new LogPenambahanDosbing;
            $log->id_admin = Auth::user()->admin->id;
            $log->nama_admin = Auth::user()->admin->nama;
            $log->nim = $request->nim;
            $log->nip_dosbing1 = $request->dosbing1;
            $log->nip_dosbing2 = $request->dosbing2;
            $log->save();

            // mengubah status akses
            DB::select("CALL tahapPertama($request->nim)");
            return redirect('/admin/list_dosbing')->with('status', 'Dosen pembimbing berhasil didaftarkan!');
        } else {
            return redirect('/admin/list_dosbing')->with('prohibited', 'Dosbing I dan dosbing II harus merupakan dua dosen yang berbeda!');
        }
    }

    public function edit_dosbing(Request $request)
    {
        $nim    = $request->nim;
        $nama   = $request->nama;

        $dosbing1 = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->join('dosens as d', 'dp.nip_dosbing1', '=', 'd.nip')
            ->select('d.nama', 'd.nip')
            ->where('dp.nim', '=', $nim)
            ->first();
        $dosbing2 = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->join('dosens as d', 'dp.nip_dosbing2', '=', 'd.nip')
            ->select('d.nama', 'd.nip')
            ->where('dp.nim', '=', $nim)
            ->first();

        $dosens = Dosen::select('nama', 'nip')->get();
        return view('admin/edit_dosbing', compact('nim', 'nama', 'dosbing1', 'dosbing2', 'dosens'));
    }

    public function store_new_dosbing(Request $request)
    {
        $validated = $request->validate([
            'new_dosbing1'     => 'required',
            'new_dosbing2'     => 'required'
        ]);

        if ($request->new_dosbing1 != $request->new_dosbing2) {
            // penambahan log update data dosbing
            $log = new LogPengubahanDosbing;
            $log->id_admin = Auth::user()->admin->id;
            $log->nama_admin = Auth::user()->admin->nama;
            $log->nim = $request->nim;
            $log->old_nip_dosbing1 = $request->old_dosbing1;
            $log->new_nip_dosbing1 = $request->new_dosbing1;
            $log->old_nip_dosbing2 = $request->old_dosbing2;
            $log->new_nip_dosbing2 = $request->new_dosbing2;
            $log->save();

            DosenPembimbing::where('nim', $request->nim)->update([
                'nip_dosbing1' => $request->new_dosbing1,
                'nip_dosbing2' => $request->new_dosbing2,
            ]);

            return redirect('/admin/list_dosbing')->with('status', 'Data dosen pembimbing berhasil diperbaharui!');
        } else {
            return redirect('/admin/list_dosbing')->with('prohibited', 'Dosbing I dan dosbing II harus merupakan dua dosen yang berbeda!');
        }
    }

    public function delete_dosbing(Request $request)
    {
        // penambahan log delete
        $dosbing = DosenPembimbing::where('nim', $request->nim)->select('nip_dosbing1 as nip1', 'nip_dosbing2 as nip2')->first();
        $log = new LogPenghapusanDosbing;
        $log->id_admin = Auth::user()->admin->id;
        $log->nama_admin = Auth::user()->admin->nama;
        $log->nim = $request->nim;
        $log->nip_dosbing1 = $dosbing->nip1;
        $log->nip_dosbing2 = $dosbing->nip2;
        $log->save();

        // mengubah status akses jadi 0
        //mahasiswa yang ngga ada dosbing, sekalipun punya judul skripsi akan tetap berstatus-akses 0
        if ((Skripsi::where('nim', $request->nim)->count()) == 0) {
            DB::select("CALL tahapPertama($request->nim)");
        }
        DosenPembimbing::where('nim', $request->nim)->delete();
        return redirect('/admin/list_dosbing')->with('status', 'Data dosen pembimbing berhasil dihapus!');
    }

    //2. skripsi
    public function list_skripsi()
    {
        // mahasiswa yang bisa mendaftarkan judul skripsi, harus punya dosen pembimbing terlebih dahulu. 
        $skripsis = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as sa', 'm.nim', '=', 'sa.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->where('sa.no_statusAkses', '>', '0')
            ->where('m.status', '=', 'Aktif')
            ->select('s.judul_skripsi', 's.bidang_ilmu', 'm.nim', 'm.nama', 'sa.no_statusAkses')
            ->get();

        return view('/admin/daftar_skripsi', compact('skripsis'));
    }

    public function add_skripsi(Request $request)
    {
        $mahasiswa = Mahasiswa::where('nim', $request->nim)
            ->select('nim')
            ->first();
        $bidang_ilmu = BidangIlmu::all();
        return view('/admin/add_skripsi', compact('mahasiswa', 'bidang_ilmu'));
    }

    public function store_skripsi(Request $request)
    {
        $validated = $request->validate([
            'judul_skripsi'         => 'required|min:20|max:255|unique:skripsis',
            'eng_judul_skripsi'     => 'required|min:20|max:255|unique:skripsis',
            'bid_tulis'             => 'required|min:10|max:255',
        ]);

        $log                    = new LogPendaftaranSkripsi;
        $log->id_user           = Auth::user()->id;
        $log->nama_pendaftar    = Auth::user()->admin->nama;
        $log->nim               = $request->nim;
        $log->judul_skripsi     = $request->judul_skripsi;
        $log->registered_by     = 'admin';
        $log->save();

        $skripsi                = new Skripsi;
        $skripsi->nim           = $request->nim;
        $skripsi->judul_skripsi = $request->judul_skripsi;
        $skripsi->eng_judul_skripsi = $request->eng_judul_skripsi;
        $skripsi->bidang_ilmu   = $request->bid_tulis;
        $skripsi->save();

        // mengubah status akses
        if ((JadwalSempro::where('nim', $request->nim)->count()) > 0) {
            DB::select("CALL tahapPertama($request->nim)");
            return redirect('/admin/list_skripsi')->with('status', 'Judul berhasil disimpan!');
        } else {
            return redirect('/admin/list_skripsi')->with('status', 'Judul berhasil disimpan! Daftarkan jadwal sempro agar mahasiswa dapat melihat jadwalnya.');
        }
    }

    public function edit_skripsi(Request $request)
    {
        $bidang_ilmu = BidangIlmu::all();
        $mahasiswa = Skripsi::where('nim', $request->nim)->select('nim', 'judul_skripsi', 'eng_judul_skripsi', 'bidang_ilmu')->first();
        return view('admin.edit_skripsi', compact('mahasiswa', 'bidang_ilmu'));
    }

    public function store_new_skripsi(Request $request)
    {
        $validated = $request->validate([
            'new_judul_skripsi'  => 'required|min:20|max:255',
            'new_eng_judul_skripsi'  => 'required|min:20|max:255',
            'new_bid_ilmu' => 'required|min:10|max:255',
        ]);

        if ($request->new_judul_skripsi != $request->old_judul) {
            if (Skripsi::where('judul_skripsi', $request->new_judul_skripsi)->count() > 1) {
                return redirect('/mahasiswa/pra_sempro')->with('prohibited', 'Judul skripsi sudah terdaftar sebagai milik mahasiswa lain.');
            } else if (Skripsi::where('eng_judul_skripsi', $request->new_judul_skripsi)->count() > 1) {
                return redirect('/mahasiswa/pra_sempro')->with('prohibited', 'Judul skripsi dalam bahasa inggris sudah terdaftar sebagai milik mahasiswa lain.');
            } else {
                // penambahan log pengubahan skripsi
                $log                    = new LogPengubahanSkripsi;
                $log->id_user           = Auth::user()->id;
                $log->nama_pengubah     = Auth::user()->admin->nama;
                $log->nim               = $request->nim;
                $log->old_judul_skripsi = $request->old_judul_skripsi;
                $log->new_judul_skripsi = $request->new_judul_skripsi;
                $log->old_bidang_ilmu   = $request->old_bid_ilmu;
                $log->new_bidang_ilmu   = $request->new_bid_ilmu;
                $log->edited_by         = 'admin';
                $log->save();

                Skripsi::where('nim', $request->nim)->update([
                    'judul_skripsi'         => $request->new_judul_skripsi,
                    'eng_judul_skripsi'     => $request->new_eng_judul_skripsi,
                    'bidang_ilmu'           => $request->new_bid_ilmu,
                ]);

                return redirect('/admin/list_skripsi')->with('status', 'Judul skripsi sudah diperbaharui!');
            }
        } else {
            Skripsi::where('nim', $request->nim)->update([
                'judul_skripsi'   => $request->new_judul_skripsi,
                'bidang_ilmu'     => $request->bid_ilmu,
            ]);
            return redirect('/admin/list_skripsi')->with('status', 'Judul skripsi sudah diperbaharui!');
        }
    }

    public function delete_skripsi(Request $request)
    {
        $skripsi = Skripsi::where('nim', $request->nim)->select('nim', 'judul_skripsi', 'bidang_ilmu')->first();

        // menambahkan ke log hapus skripsi
        $log                = new LogPenghapusanSkripsi;
        $log->id_admin      = Auth::user()->admin->id;
        $log->nama_admin    = Auth::user()->admin->nama;
        $log->nim           = $skripsi->nim;
        $log->judul_skripsi = $skripsi->judul_skripsi;
        $log->bidang_ilmu   = $skripsi->bidang_ilmu;
        $log->save();

        // mengubah status akses
        if ((DosenPembimbing::where('nim', $request->nim)->count()) == 0) {
            DB::select("CALL tahapPertama($request->nim)");
        }

        Skripsi::where('nim', $request->nim)->delete();
        return redirect('/admin/list_skripsi')->with('status', 'Judul skripsi berhasil dihapus!');
    }

    // 3. berkas administrasi
    public function validasi_sempro()
    {
        $query = DB::table('v_jdSempro as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->select('js.nama', 'js.nim', 'st.no_statusAkses')
            ->orderBy('tanggal_sempro', 'DESC')
            ->paginate(25);
        return view('admin/berkas_prasempro', compact('query'));
    }

    public function form_validasi_berkas($nim)
    {
        $this->nim = $nim;
        $mahasiswa = DB::table('v_jdSempro')->where('nim', $nim)->select('nim', 'nama')->first();
        return view('admin.berkas.form_validasi_berkas', compact('mahasiswa'));
    }

    public function berita_acara_sempro($nim)
    {
        $mahasiswa = DB::table('v_jdSempro')->where('nim', $nim)->select('nama', 'nim', 'bidang_TA', 'judul_skripsi', 'nama_dosen', 'nip', 'tanggal_sempro', 'waktu')->get();
        return view('admin.berkas.berita_acara_sempro', compact('mahasiswa'));
    }

    public function undangan_sempro()
    {
        return view('admin.berkas.undangan_sempro');
    }

    public function lembar_kendali_sempro($nim)
    {


        $data       = DB::table('mahasiswas as m')
            ->join('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_sempros as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_sempro')
            ->where('m.nim', '=', $nim)
            ->first();
        $bimbingan_sempro = DB::table('bimbingan_sempro')->where('nim', $nim)->get();
        // dd($bimbingan_sempro);
        $tanggal    = Carbon::parse($data->tanggal_sempro)->translatedFormat('l, d F Y');
        return view('admin.berkas.lembar_kendali_sempro', compact('data', 'tanggal', 'bimbingan_sempro'));
    }

    public function form_penilaian_sempro($nim)
    {
        $query = DB::table('v_jdSempro')->where('nim', $nim)->select('nama', 'nim', 'bidang_TA', 'judul_skripsi', 'nama_dosen', 'nip', 'tanggal_sempro', 'waktu')->get();
        // $nilai_kelayakan = NilaiUjiKelayakan::where('nim', $nim)->get();
        // ambil data dari tabel nilai uji kelayakans berdasarkan nim
        $nilai_kelayakan = DB::table('nilai_uji_kelayakans')->where('nim', $nim)->get();
        dd($nilai_kelayakan);
        return view('admin.berkas.form_penilaian_sempro', compact('query', 'nilai_kelayakan'));
    }

    public function approve_sempro($nim)
    {
        DB::select("CALL tahapKetiga($nim)");
        return redirect('admin/validasi_sempro')->with('status', 'Mahasiswa Lulus Sempro! Mahasiswa akan melanjutkan ke proses persiapan seminar hasil.');
    }

    public function decline_sempro($nim)
    {
        DB::select("CALL tahapPertama($nim)");
        JadwalSempro::where('nim', $nim)->delete();
        return redirect('admin/validasi_sempro')->with('prohibited', 'Seminar proposal ditolak! Mahasiswa akan mengulang sempro.');
    }

    public function pesertaSempro()
    {
        $query = DB::table('v_jdSempro')->get();
        return view('admin.berkas.pesertaSempro', compact('query'));
    }

    //INI MON
    public function cetakSempro()
    {
        $query = DB::table('jadwal_sempros')
            ->select('tanggal_sempro')
            ->distinct()->orderBy('tanggal_sempro', 'ASC')
            ->get();
        return view('admin.jadwal_sempro', compact('query'));
    }

    //INI MON
    public function cetakJadwalSempro(Request $request)
    {
        $tanggal_sempro = $request->tanggal_sempro;

        $query = DB::table('v_jdSempro as js')
            ->where('js.tanggal_sempro', '=', $tanggal_sempro)
            ->get();

        return view('admin.berkas.pesertaSempro', compact('query'));
    }

    //INI MON
    public function cetakUndanganSempro(Request $request)
    {
        $tanggal_sempro = $request->tanggal_sempro;

        $query = DB::table('v_jdSempro as js')
            ->where('js.tanggal_sempro', '=', $tanggal_sempro)
            ->get();

        return view('admin.berkas.undangan_sempro', compact('query'));
    }

    // END FUNGSI UNTUK MENU PRA SEMPRO
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FUNGSI UNTUK MAHASISWA TINGKAT AKHIR   
    public function mahasiswa_ta()
    {
        return view('admin/menu_mahasiswa_TA');
    }

    public function mahasiswa_aktif()
    {
        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        $mahasiswas = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->join('status_akses as sa', 'm.nim', '=', 'sa.nim')
            ->join('keterangan_status_akses as k', 'sa.no_statusAkses', '=', 'k.no_statusAkses')
            // ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->orderBy('v.nim', 'ASC')
            ->orderBy('m.angkatan', 'ASC')
            ->paginate(25);
        return view('admin/mhs_TA_aktif', compact('mahasiswas', 'angkatan'));
    }

    public function alumni()
    {
        $alumnus = DB::table('log_mahasiswa_luluses')
            ->select('nim', 'nama', 'judul_skripsi', 'bidang_ilmu', 'nip_dosbing1', 'nama_dosbing1', 'nip_dosbing2', 'nama_dosbing2')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        return view('admin/alumni', compact('alumnus'));
    }

    public function cari_mhs(Request $request)
    {
        $mahasiswas = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->join('status_akses as sa', 'm.nim', '=', 'sa.nim')
            ->join('keterangan_status_akses as k', 'sa.no_statusAkses', '=', 'k.no_statusAkses')
            // ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('v.nama_mhs', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('k.keterangan', 'like', "%" . $request->keyword . "%")
            ->orWhere('m.angkatan', '=', $request->keyword)
            ->orWhere('s.judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nama_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nama_dosbing2', 'like', "%" . $request->keyword . "%")
            ->orderBy('m.nim', 'ASC')
            ->orderBy('m.angkatan', 'ASC')
            ->paginate(25);
        $counter = $mahasiswas->count();
        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        return view('admin/hasil_pencarian', compact('mahasiswas', 'counter', 'angkatan'));
    }

    public function cari_alumni(Request $request)
    {
        $results = DB::table('log_mahasiswa_luluses as l')
            ->select('l.nim', 'l.nama', 'l.judul_skripsi', 'l.bidang_ilmu', 'l.nip_dosbing1', 'nama_dosbing1', 'nip_dosbing2', 'nama_dosbing2')
            ->where('l.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.bidang_ilmu', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing2', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama_dosbing2', 'like', "%" . $request->keyword . "%")
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        $counter = $results->count();
        return view('admin/hasil_pencarian8', compact('results', 'counter'));
    }

    public function filter(Request $request)
    {
        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        $keterangan = DB::table('keterangan_status_akses as k')
            ->select('k.no_statusAkses', 'k.keterangan')
            ->get();

        $mahasiswas = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->join('status_akses as sa', 'm.nim', '=', 'sa.nim')
            ->join('keterangan_status_akses as k', 'sa.no_statusAkses', '=', 'k.no_statusAkses')
            // ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('m.angkatan', '=', $request->angkatan)
            ->orderBy('v.nim', 'ASC')
            ->paginate(25);

        $sum = $mahasiswas->count();
        $tahun = $request->angkatan;
        return view('admin.filter', compact('mahasiswas', 'keterangan', 'sum', 'angkatan', 'tahun'));
    }

    public function filter2(Request $request)
    {
        $keterangan = DB::table('keterangan_status_akses as k')
            ->select('k.no_statusAkses', 'k.keterangan')
            ->get();

        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();

        $mahasiswas = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->join('status_akses as sa', 'm.nim', '=', 'sa.nim')
            ->join('keterangan_status_akses as k', 'sa.no_statusAkses', '=', 'k.no_statusAkses')
            // ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('m.angkatan', '=', $request->tahun)
            ->where('sa.no_statusAkses', '=', $request->no_statusAkses)
            ->orderBy('v.nim', 'ASC')
            ->paginate(25);
        $tahun = $request->tahun;
        $sum = $mahasiswas->count();
        return view('admin.filter2', compact('mahasiswas', 'keterangan', 'sum', 'angkatan', 'tahun'));
    }
    // END FUNGSI UNTUK MAHASISWA TA
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FUNGSI UNTUK RIWAYAT AKTIVITAS
    public function log_aktivitas()
    {
        return view('admin.log_aktivitas');
    }

    public function log_pendaftaran_dosbing()
    {
        $logs = DB::table('log_penambahan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.nip_dosbing1', 'l.nip_dosbing2', 'l.created_at', 'm.nama')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        return view('admin.log_pendaftaran_dosbing', compact('logs'));
    }

    public function cari_log_daftar_dosbing(Request $request)
    {
        $results = DB::table('log_penambahan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.nip_dosbing1', 'l.nip_dosbing2', 'l.created_at', 'm.nama')
            ->where('m.nama', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.id_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing2', 'like', "%" . $request->keyword . "%")
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian2', compact('results', 'counter'));
    }

    public function log_pengubahan_dosbing()
    {
        $logs = DB::table('log_pengubahan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.old_nip_dosbing1', 'l.new_nip_dosbing1', 'l.old_nip_dosbing2', 'l.new_nip_dosbing2', 'l.created_at', 'm.nama')
            ->paginate(25);
        return view('admin.log_pengubahan_dosbing', compact('logs'));
    }

    public function cari_log_ubah_dosbing(Request $request)
    {
        $results = DB::table('log_pengubahan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.new_nip_dosbing1', 'l.old_nip_dosbing1', 'l.new_nip_dosbing2', 'l.old_nip_dosbing2', 'l.created_at', 'm.nama')
            ->where('m.nama', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.id_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.old_nip_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.new_nip_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.old_nip_dosbing2', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.new_nip_dosbing2', 'like', "%" . $request->keyword . "%")
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian3', compact('results', 'counter'));
    }

    public function log_penghapusan_dosbing()
    {
        $logs = DB::table('log_penghapusan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.nip_dosbing1', 'l.nip_dosbing2', 'l.created_at', 'm.nama')
            ->paginate(25);
        return view('admin.log_penghapusan_dosbing', compact('logs'));
    }

    public function cari_log_hapus_dosbing(Request $request)
    {
        $results = DB::table('log_penghapusan_dosbings as l')
            ->join('mahasiswas as m', 'l.nim', '=', 'm.nim')
            ->select('l.id_admin', 'l.nama_admin', 'l.nim', 'l.nip_dosbing1', 'l.nip_dosbing2', 'l.created_at', 'm.nama')
            ->where('m.nama', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nama_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.id_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nip_dosbing2', 'like', "%" . $request->keyword . "%")
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian4', compact('results', 'counter'));
    }

    public function log_pendaftaran_skripsi()
    {
        $logs = DB::table('log_pendaftaran_skripsis as l')
            ->select('l.id_user', 'l.nim', 'l.nama_pendaftar', 'l.registered_by', 'l.judul_skripsi', 'l.created_at')
            ->paginate(25);
        return view('admin.log_pendaftaran_skripsi', compact('logs'));
    }

    public function cari_log_daftar_skripsi(Request $request)
    {
        $results = DB::table('log_pendaftaran_skripsis as l')
            ->select('l.id_user', 'l.nim', 'l.nama_pendaftar', 'l.registered_by', 'l.judul_skripsi', 'l.created_at')
            ->where('l.nama_pendaftar', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian5', compact('results', 'counter'));
    }

    public function log_pengubahan_skripsi()
    {
        $logs = DB::table('log_pengubahan_skripsis as l')
            ->select('l.id_user', 'l.nim', 'l.nama_pengubah', 'l.edited_by', 'l.old_judul_skripsi', 'l.new_judul_skripsi', 'l.created_at')
            ->paginate(25);
        return view('admin.log_pengubahan_skripsi', compact('logs'));
    }

    public function cari_log_ubah_skripsi(Request $request)
    {
        $results = DB::table('log_pengubahan_skripsis as l')
            ->select('l.id_user', 'l.nim', 'l.nama_pengubah', 'l.edited_by', 'l.old_judul_skripsi', 'l.new_judul_skripsi', 'l.created_at')
            ->where('l.nama_pengubah', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.old_judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.new_judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian6', compact('results', 'counter'));
    }

    public function log_penghapusan_skripsi()
    {
        $logs = DB::table('log_penghapusan_skripsis as l')
            ->select('l.id_admin', 'l.nim', 'l.nama_admin', 'l.judul_skripsi', 'l.bidang_ilmu', 'l.created_at')
            ->paginate(25);
        return view('admin.log_penghapusan_skripsi', compact('logs'));
    }

    public function cari_log_hapus_skripsi(Request $request)
    {
        $results = DB::table('log_penghapusan_skripsis as l')
            ->select('l.id_admin', 'l.nim', 'l.nama_admin', 'l.judul_skripsi', 'l.bidang_ilmu', 'l.created_at')
            ->where('l.nama_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.id_admin', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.bidang_ilmu', 'like', "%" . $request->keyword . "%")
            ->orWhere('l.nim', 'like', "%" . $request->keyword . "%")
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        $counter = $results->count();
        return view('admin.hasil_pencarian7', compact('results', 'counter'));
    }

    // END OF FUNGSI UNTUK MENU RIWAYAT AKTIVITAS
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    //FUNGSI UNTUK MENU Profil
    public function profile_saya()
    {
        return view('admin.profile');
    }

    public function store_new_admin(Request $request)
    {
        $validated = $request->validate([
            'nama'  => 'required|min:5|max:255',
            'new_email' => 'required|min:10|max:255|email',
        ]);

        if ($request->new_email != $request->old_email) {
            if ((User::where('email', $request->new_email)->count()) > 0) {
                return redirect('/admin/my_profile')->with('prohibited', 'Email sudah terdaftar!');
            } else {
                Admin::where('id_user', $request->id)->update([
                    'nama' => $request->nama,
                ]);

                User::where('id', $request->id)->update([
                    'email' => $request->new_email,
                ]);

                return redirect('/admin/my_profile')->with('status', 'Perubahan profile berhasil!');
            }
        } else {

            Admin::where('id_user', '=', $request->id)->update([
                'nama' => $request->nama,
            ]);
            return redirect('/admin/my_profile')->with('status', 'Perubahan profile berhasil!');
        }
    }
    // END OF FUNGSI UNTUK MENU Profil
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FUNGSI UNTUK MENU PRA SEMHAS
    public function page_pra_semhas()
    {
        return view('admin/pra_semhas');
    }

    // 1. dosen penguji
    public function list_dosenPenguji()
    {
        $mahasiswas = DB::table('jadwal_semhas as m')
            ->join('mahasiswas as mh', 'm.nim', '=', 'mh.nim')
            ->leftJoin('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->select('mh.nama', 'm.nim', 'dp.nip_dosen_penguji1', 'dp.nama_dosen_penguji1', 'dp.nip_dosen_penguji2', 'dp.nama_dosen_penguji2')
            ->where('mh.status', '=', 'Aktif')
            ->paginate(10);
        return view('admin/daftar_dosenPenguji', compact('mahasiswas'));
    }

    public function add_dosen_penguji(Request $request)
    {
        $nim = $request->nim;
        $nama_mhs = $request->nama;

        $dosens = Dosen::select('nip', 'nama')->get();
        return view('admin/add_dosen_penguji', compact('nim', 'nama_mhs', 'dosens'));
    }

    public function store_dosen_penguji(Request $request)
    {
        $validated = $request->validate([
            'dosen_penguji1'     => 'required',
            'dosen_penguji2'     => 'required',
        ]);

        if ($request->dosen_penguji1 != $request->dosen_penguji2) {
            $doping = DosenPembimbing::where('nim', $request->nim)->first();
            if ($doping->nip_dosbing1 == $request->dosen_penguji1 || $doping->nip_dosbing2 == $request->dosen_penguji1) {
                return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji I sudah terdaftar sebagai dosen pembimbing mahasiswa yang bersangkutan!');
            } else if ($doping->nip_dosbing1 == $request->dosen_penguji2 || $doping->nip_dosbing2 == $request->dosen_penguji2) {
                return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji II sudah terdaftar sebagai dosen pembimbing mahasiswa yang bersangkutan!');
            } else {
                if (JadwalSemhas::where('nim', $request->nim)->count() > 0) {
                    DB::select("CALL tahapKeempat($request->nim)");
                    $dosen_penguji               = new DosenPenguji;
                    $dosen_penguji->nim          = $request->nim;
                    $dosen_penguji->nip_penguji1 = $request->dosen_penguji1;
                    $dosen_penguji->nip_penguji2 = $request->dosen_penguji2;
                    $dosen_penguji->save();
                    return redirect('/admin/list_dosenPenguji')->with('status', 'Dosen penguji berhasil didaftarkan!');
                } else {
                    $dosen_penguji               = new DosenPenguji;
                    $dosen_penguji->nim          = $request->nim;
                    $dosen_penguji->nip_penguji1 = $request->dosen_penguji1;
                    $dosen_penguji->nip_penguji2 = $request->dosen_penguji2;
                    $dosen_penguji->save();
                    return redirect('/admin/list_dosenPenguji')->with('status', 'Dosen penguji berhasil didaftarkan!');
                }
            }
        } else {
            return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji I dan dosen penguji II harus merupakan dua dosen yang berbeda!');
        }
    }

    public function edit_dosen_penguji(Request $request)
    {
        $nim    = $request->nim;
        $nama   = $request->nama;

        $dosen_penguji1 = DB::table('mahasiswas as m')
            ->join('dosen_pengujis as dp', 'm.nim', '=', 'dp.nim')
            ->join('dosens as d', 'dp.nip_penguji1', '=', 'd.nip')
            ->select('d.nama', 'd.nip')
            ->where('dp.nim', '=', $nim)
            ->first();
        $dosen_penguji2 = DB::table('mahasiswas as m')
            ->join('dosen_pengujis as dp', 'm.nim', '=', 'dp.nim')
            ->join('dosens as d', 'dp.nip_penguji2', '=', 'd.nip')
            ->select('d.nama', 'd.nip')
            ->where('dp.nim', '=', $nim)
            ->first();

        $dosens = Dosen::select('nama', 'nip')->get();
        return view('admin/edit_dosen_penguji', compact('nim', 'nama', 'dosen_penguji1', 'dosen_penguji2', 'dosens'));
    }

    public function store_new_dosen_penguji(Request $request)
    {
        $validated = $request->validate([
            'dosen_penguji1'     => 'required',
            'dosen_penguji2'     => 'required'
        ]);

        if ($request->dosen_penguji1 != $request->dosen_penguji2) {
            if ($request->dosen_penguji1 != $request->dosen_penguji2) {
                $doping = DosenPembimbing::where('nim', $request->nim)->first();
                if ($doping->nip_dosbing1 == $request->dosen_penguji1 || $doping->nip_dosbing2 == $request->dosen_penguji1) {
                    return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji I sudah terdaftar sebagai dosen pembimbing mahasiswa yang bersangkutan!');
                } else if ($doping->nip_dosbing1 == $request->dosen_penguji2 || $doping->nip_dosbing2 == $request->dosen_penguji2) {
                    return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji II sudah terdaftar sebagai dosen pembimbing mahasiswa yang bersangkutan!');
                } else {
                    DosenPenguji::where('nim', $request->nim)->update([
                        'nip_penguji1' => $request->dosen_penguji1,
                        'nip_penguji2' => $request->dosen_penguji2,
                    ]);

                    return redirect('/admin/list_dosenPenguji')->with('status', 'Data dosen penguji berhasil diperbaharui!');
                }
            }
        } else {
            return redirect('/admin/list_dosenPenguji')->with('prohibited', 'Dosen penguji I dan dosen penguji II harus merupakan dua dosen yang berbeda!');
        }
    }

    public function delete_dosen_penguji(Request $request)
    {
        DosenPenguji::where('nim', $request->nim)->delete();
        return redirect('/admin/list_dosenPenguji')->with('status', 'Data dosen pembimbing berhasil dihapus!');
    }

    // 2. berkas administrasi
    public function validasi_semhas()
    {
        $query = DB::table('v_jdSemhas as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->select('js.nama', 'js.nim', 'st.no_statusAkses')
            ->where('st.no_statusAkses', '>', 3)
            ->paginate(25);
        return view('admin/berkas_prasemhas', compact('query'));
    }

    public function approve_semhas($nim)
    {
        DB::select("CALL tahapKelima($nim)");
        return redirect('admin/validasi_semhas')->with('status', 'Mahasiswa Lulus Seminar Hasil! Mahasiswa akan melanjutkan ke proses persiapan sidang.');
    }

    public function decline_semhas($nim)
    {
        DB::select("CALL tahapKetiga($nim)");
        JadwalSemhas::where('nim', $nim)->delete();
        return redirect('admin/validasi_semhas')->with('prohibited', 'Seminar hasil ditolak! Mahasiswa akan mengulang seminar hasil.');
    }

    public function pesertaSemhas()
    {
        $query = DB::table('v_jdsemhas as m')
            ->leftJoin('v_dosen_penguji as db', 'm.nim', '=', 'db.nim')
            ->select('m.nama', 'm.nim', 'm.judul_skripsi', 'm.nama_dosen', 'm.tanggal_semhas', 'm.waktu', 'm.tempat', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->get();
        return view('admin.berkas.pesertaSemhas', compact('query'));
    }

    public function form_persetujuan_semhas($nim)
    {
        $query = DB::table('v_jdSemhas')->where('nim', $nim)->select('nama', 'nim', 'judul_skripsi', 'nama_dosen', 'nip', 'tanggal_semhas', 'waktu')->get();
        return view('admin.berkas.form_persetujuan_semhas', compact('query'));
    }

    public function berita_acara_semhas($nim)
    {
        $this->nim = $nim;
        $mahasiswa = DB::table('v_jdsemhas as m')
            ->leftJoin('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('daftar_nilai_semhas as sm', 'm.nim', '=', 'sm.nim')
            ->leftJoin('dosens as d', 'sm.nip', '=', 'd.nip')
            ->select(
                'm.nama',
                'm.nim',
                'm.judul_skripsi',
                'm.bidang_TA',
                'm.nama_dosen',
                'm.nip',
                'm.tanggal_semhas',
                'm.waktu',
                'dp.nama_dosen_penguji1',
                'dp.nip_dosen_penguji1',
                'dp.nama_dosen_penguji2',
                'dp.nip_dosen_penguji2',
                'd.nama',
                'sm.total'
            )
            ->where('m.nim', $nim)
            ->get();
        // dd($mahasiswa);

        return view('admin.berkas.berita_acara_semhas', compact('mahasiswa'));
    }

    public function undangan_semhas()
    {
        return view('admin.berkas.undangan_semhas');
    }

    public function lembar_kendali_semhas($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->join('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_semhas')
            ->where('m.nim', '=', $nim)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_semhas)->translatedFormat('l, d F Y');
        return view('admin.berkas.lembar_kendali_semhas', compact('data', 'tanggal'));
    }

    public function form_penilaian_uji_program($nim)
    {
        $query = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_uji_program as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->leftJoin('v_dosbing as v', 'n.nim', '=', 'v.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('nilai_uji_programs as nu', 'm.nim', '=', 'nu.nim')
            ->select(
                'm.nama',
                'm.nim',
                'nu.tanggal',
                'nu.waktu',
                's.bidang_ilmu',
                's.judul_skripsi',
                'd.nama as nama_dsn',
                'd.nip',
                'n.nilai_kemampuan_dasar_program as n1',
                'n.nilai_kecocokan_algoritma as n2',
                'n.nilai_penguasaan_program as n3',
                'n.nilai_penguasaan_ui as n4',
                'n.nilai_validasi_output as n5',
                'v.nip_dosbing1',
                'v.nama_dosbing1',
                'v.nip_dosbing2',
                'v.nama_dosbing2'
            )
            ->where('m.nim', $nim)
            ->first();
        return view('admin.berkas.form_penilaian_uji_program', compact('query'));
    }

    public function form_penilaian_semhas($nim)
    {
        $query = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_semhas as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->leftJoin('v_dosen_penguji as v', 'n.nim', '=', 'v.nim')
            ->leftJoin('v_dosbing as f', 'n.nim', '=', 'f.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select(
                'm.nama',
                'm.nim',
                'j.tanggal_semhas',
                's.bidang_ilmu',
                's.judul_skripsi',
                'd.nama as nama_dsn',
                'd.nip',
                'v.nip_dosen_penguji1',
                'v.nama_dosen_penguji1',
                'v.nip_dosen_penguji2',
                'v.nama_dosen_penguji2',
                'n.abstrak as n1',
                'n.pendahuluan as n2',
                'n.landasan_teori as n3',
                'n.metodologi as n4',
                'n.implementasi as n5',
                'n.kesimpulan as n6',
                'n.kemampuan_mengemukakan_substansi as n7',
                'd.nama as nama_dosen'
            )
            ->where('m.nim', $nim)
            ->first();
        return view('admin.berkas.form_penilaian_semhas', compact('query'));
    }

    public function cetakSemhas()
    {
        $query = DB::table('jadwal_semhas')
            ->select('tanggal_semhas')
            ->distinct()->orderBy('tanggal_semhas', 'ASC')
            ->get();
        return view('admin.jadwal_semhas', compact('query'));
    }

    public function cetakJadwalSemhas(Request $request)
    {
        $tanggal_semhas = $request->tanggal_semhas;

        $query = DB::table('v_jdSemhas as js')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_semhas', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_semhas', '=', $tanggal_semhas)
            ->get();

        return view('admin.berkas.pesertaSemhas', compact('query'));
    }

    public function cetakUndanganSemhas(Request $request)
    {
        $tanggal_semhas = $request->tanggal_semhas;

        $query = DB::table('v_jdSemhas as js')
            ->where('js.tanggal_semhas', '=', $tanggal_semhas)
            ->get();

        return view('admin.berkas.undangan_semhas', compact('query'));
    }


    // END FUNGSI UNTUK MENU PRA SEMHAS
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FUNGSI UNTUK MENU PRA SIDANG MEJA HIJAU
    public function validasi_sidang()
    {
        $query = DB::table('jdsidangmejahijau as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->select('js.nama', 'js.nim', 'st.no_statusAkses')
            ->get();

        $nilai = DB::table('jdsidangmejahijau as js')
            ->leftJoin('daftar_nilai_semhas as sm', 'js.nim', '=', 'sm.nim')
            ->select('sm.total as total_semhas')
            ->get();
        // dd($nilai);
        return view('admin/berkas_prasidangmejahijau', compact('query', 'nilai'));
    }

    public function approve_sidang($nim)
    {
        DB::select("CALL tahapKetujuh($nim)");

        $data = DB::table('mahasiswas as m')
            ->join('v_dosbing as v', 'm.nim', '=', 'v.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->select('m.nama', 'm.nim', 's.judul_skripsi', 's.bidang_ilmu', 'v.nip_dosbing1', 'v.nip_dosbing2', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.nim', $nim)
            ->first();

        $log                    = new LogMahasiswaLulus;
        $log->nim             = $data->nim;
        $log->nama            = $data->nama;
        $log->judul_skripsi   = $data->judul_skripsi;
        $log->bidang_ilmu     = $data->bidang_ilmu;
        $log->nip_dosbing1    = $data->nip_dosbing1;
        $log->nama_dosbing1   = $data->nama_dosbing1;
        $log->nip_dosbing2    = $data->nip_dosbing2;
        $log->nama_dosbing2   = $data->nama_dosbing2;
        $log->save();

        return redirect('admin/validasi_sidang')->with('status', 'Selamat! Mahasiswa akan segera wisuda!');
    }

    public function decline_sidang($nim)
    {
        DB::select("CALL tahapKelima($nim)");
        JadwalSidang::where('nim', $nim)->delete();
        return redirect('admin/validasi_sidang')->with('prohibited', 'Sidang meja hijau ditolak! Mahasiswa akan mengulang sidang meja hijau');
    }

    public function pesertaSidang()
    {
        $query = DB::table('jdsidangmejahijau as m')
            ->leftJoin('v_dosen_penguji as db', 'm.nim', '=', 'db.nim')
            ->select('m.nama', 'm.nim', 'm.judul_skripsi', 'm.nama_dosen', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->get();

        return view('admin.berkas.pesertaSidang', compact('query'));
    }

    public function form_persetujuan_sidang($nim)
    {
        $query = DB::table('jdsidangmejahijau as m')
            ->leftJoin('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->select('m.nama', 'm.nim', 'm.judul_skripsi', 'm.nama_dosen', 'm.nip', 'm.tanggal_sidang', 'm.waktu', 'dp.nama_dosen_penguji1', 'dp.nip_dosen_penguji1', 'dp.nama_dosen_penguji2', 'dp.nip_dosen_penguji2')
            ->where('m.nim', $nim)
            ->get();

        return view('admin.berkas.form_persetujuan_sidang', compact('query'));
    }

    public function berita_acara_sidang($nim)
    {
        $query = DB::table('jdsidangmejahijau as jd')
            ->join('skripsis as s', 'jd.nim', '=', 's.nim')
            ->where('jd.nim', $nim)->select('jd.nama', 'jd.nim', 'jd.judul_skripsi', 'jd.tanggal_sidang', 'jd.nama_dosen', 's.eng_judul_skripsi')
            ->get();
        //dd($query);

        $dosen_penguji = DB::table('v_dosen_penguji')
            ->select('nama_dosen_penguji1', 'nama_dosen_penguji2', 'nip_dosen_penguji1')
            ->where('nim', $nim)->get();

        $semhas = DB::table('daftar_nilai_semhas as n')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->select(
                'd.nip',
                'd.nama as nama_dsn',
                'n.abstrak as n1',
                'n.pendahuluan as n2',
                'n.landasan_teori as n3',
                'n.metodologi as n4',
                'n.implementasi as n5',
                'n.kesimpulan as n6',
                'n.kemampuan_mengemukakan_substansi as n7',
                'n.total as total_semhas'
            )
            ->where('nim', $nim)
            ->get();


        $uji = DB::table('daftar_nilai_uji_program as n')
            ->select(
                'n.nilai_kemampuan_dasar_program as n1',
                'n.nilai_kecocokan_algoritma as n2',
                'nilai_penguasaan_program as n3',
                'n.nilai_penguasaan_ui as n4',
                'n.nilai_validasi_output as n5',
                'n.total as total_uji'
            )
            ->where('nim', $nim)
            ->get();

        // $ipk = DB::table('nilai_i_p_k_s as n')
        //     ->select('n.IPK')
        //     ->where('nim', $nim)
        //     ->get();
        // $ipk = '';

        $sidang = DB::table('daftar_nilai_sidang as n')
            ->join('dosens as d', 'n.nip', '=', 'd.nip')
            ->select(
                'd.nama as nama_dsn',
                'd.nip',
                'n.sistematika_penulisan as n1',
                'n.substansi as n2',
                'n.kemampuan_menguasai_substansi as n3',
                'n.kemampuan_mengemukakan_pendapat as n4',
                'n.total as total_sidang'
            )
            ->where('nim', $nim)
            ->get();
        return view('admin.berkas.berita_acara_sidang', compact('query', 'semhas', 'uji', 'sidang', 'dosen_penguji'));
    }

    public function berita_acara_sidang_kosong($nim)
    {
        $query = DB::table('jdsidangmejahijau')
            ->where('nim', $nim)->select('nama', 'nim', 'judul_skripsi', 'tanggal_sidang', 'nama_dosen')
            ->get();
        // dd($query);
        return view('admin.berita_acara_sidang_kosong', compact('query'));
    }

    public function lembar_kendali_sidang($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->join('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_sidang')
            ->where('m.nim', '=', $nim)
            ->first();

        $tanggal    = Carbon::parse($data->tanggal_sidang)->translatedFormat('l, d F Y');
        return view('admin.berkas.lembar_kendali_sidang', compact('data', 'tanggal'));
    }

    public function kata_pengantar_sidang($nim)
    {
        $query = DB::table('jdsidangmejahijau')->where('nim', $nim)->select('nama', 'nim')->get();
        return view('admin.berkas.kata_pengantar_sidang', compact('query'));
    }

    public function undangan_sidang()
    {
        return view('admin.berkas.undangan_sidang');
    }

    public function form_penilaian_sidang($nim)
    {
        $query = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_sidang as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->leftJoin('v_dosen_penguji as v', 'n.nim', '=', 'v.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select(
                'm.nama',
                'm.nim',
                'j.tanggal_sidang',
                's.bidang_ilmu',
                's.judul_skripsi',
                'd.nama as nama_dsn',
                'd.nip',
                'v.nip_dosen_penguji1',
                'v.nama_dosen_penguji1',
                'v.nip_dosen_penguji2',
                'v.nama_dosen_penguji2',
                'n.sistematika_penulisan as n1',
                'n.substansi as n2',
                'n.kemampuan_menguasai_substansi as n3',
                'n.kemampuan_mengemukakan_pendapat as n4',
                'd.nama as nama_penguji',
                'n.total'
            )
            ->where('m.nim', $nim)
            ->get();

        //dd($query);

        return view('admin.berkas.form_penilaian_sidang', compact('query'));
    }

    public function cetakSidang()
    {
        $query = DB::table('jadwal_sidangs')
            ->select('tanggal_sidang')
            ->distinct()->orderBy('tanggal_sidang', 'ASC')
            ->get();
        return view('admin.jadwal_sidang', compact('query'));
    }

    public function cetakJadwalSidang(Request $request)
    {
        $tanggal_sidang = $request->tanggal_sidang;

        $query = DB::table('jdsidangmejahijau as js')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_sidang', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_sidang', '=', $tanggal_sidang)
            ->get();

        return view('admin.berkas.pesertaSidang', compact('query'));
    }

    public function cetakUndanganSidang(Request $request)
    {
        $tanggal_sidang = $request->tanggal_sidang;

        $query = DB::table('jdsidangmejahijau as js')->select('js.waktu', 'js.tanggal_sidang', 'js.tempat')
            ->where('js.tanggal_sidang', '=', $tanggal_sidang)->get();
        return view('admin.berkas.undangan_sidang', compact('query'));
    }
    // END FUNGSI UNTUK MENU PRA SIDANG MEJA HIJAU


    // FUNGSI UNTUK INPUT NILAI
    public function input_nilai()
    {
        return view('admin.input_nilai');
    }

    // 1. input nilai uji program
    public function daftar_nilai_uji_program()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_uji_program as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->join('status_akses as s', 'm.nim', 's.nim')
            ->select('m.nama', 'm.nim', 'd.nip', 'd.nama as nama_dsn', 'n.total')
            ->orderBy('nim')
            ->where('m.status', 'aktif')
            ->where('s.no_statusAkses', '>=', 3)
            ->orderBy('m.nim')
            ->paginate(25);
        return view('admin.daftar_nilai_uji_program', compact('mahasiswas'));
    }

    public function add_nilai_uji_program(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosbing as v', 'm.nim', '=', 'v.nim')
            ->select('m.nim', 'm.nama', 'v.nip_dosbing1', 'v.nama_dosbing1', 'v.nip_dosbing2', 'v.nama_dosbing2')
            ->where('m.nim', $request->nim)
            ->first();
        return view('admin.add_nilai_program', compact('data'));
    }

    public function store_nilai_program(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9|unique:nilai_uji_programs',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric|digits_between:0,40',
            'n2'        => 'nullable|numeric|digits_between:0,10',
            'n3'        => 'nullable|numeric|digits_between:0,20',
            'n4'        => 'nullable|numeric|digits_between:0,10',
            'n5'        => 'nullable|numeric|digits_between:0,20',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        if (NilaiUjiProgram::where('nim', $request->nim)->count() > 0) {
            return redirect('/admin/daftar_nilai_uji_program')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
        } else {

            $n                                  = new NilaiUjiProgram;
            $n->nim                             = $request->nim;
            $n->nip                             = $request->nip;
            if ($request->n1 != NULL) {
                $n->nilai_kemampuan_dasar_program   = floatval($request->n1);
            }
            if ($request->n2 != NULL) {
                $n->nilai_kecocokan_algoritma       = floatval($request->n2);
            }
            if ($request->n3 != NULL) {
                $n->nilai_penguasaan_program        = floatval($request->n3);
            }
            if ($request->n4 != NULL) {
                $n->nilai_penguasaan_ui             = floatval($request->n4);
            }
            if ($request->n5 != NULL) {
                $n->nilai_validasi_output           = floatval($request->n5);
            }


            $n->tanggal                         = $request->tanggal;
            $n->waktu                           = $request->waktu;
            $n->save();
            return redirect('/admin/daftar_nilai_uji_program')->with('status', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_uji_program(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosbing as v', 'm.nim', '=', 'v.nim')
            ->leftJoin('daftar_nilai_uji_program as n', 'm.nim', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->select(
                'm.nim',
                'm.nama',
                'v.nip_dosbing1',
                'v.nama_dosbing1',
                'v.nip_dosbing2',
                'v.nama_dosbing2',
                'n.nilai_kemampuan_dasar_program as n1',
                'n.nilai_kecocokan_algoritma as n2',
                'n.nilai_penguasaan_program as n3',
                'n.nilai_penguasaan_ui as n4',
                'n.nilai_validasi_output as n5',
                'n.total as n6',
                'n.nip',
                'd.nama as nama_doping',
                'n.tanggal',
                'n.waktu'
            )
            ->where('m.nim', $request->nim)
            ->first();
        return view('admin.edit_nilai_program', compact('data'));
    }

    public function store_upd_nilai_uji_program(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9 |unique:nilai_uji_programs',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric|digits_between:0,40',
            'n2'        => 'nullable|numeric|digits_between:0,10',
            'n3'        => 'nullable|numeric|digits_between:0,20',
            'n4'        => 'nullable|numeric|digits_between:0,10',
            'n5'        => 'nullable|numeric|digits_between:0,20',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        NilaiUjiProgram::where('nim', $request->nim)->where('nip', $request->nip)->update([
            'nilai_kemampuan_dasar_program'   => $request->n1 ? floatval($request->n1) : null,
            'nilai_kecocokan_algoritma'       => $request->n2 ? floatval($request->n2) : null,
            'nilai_penguasaan_program'        => $request->n3 ? floatval($request->n3) : null,
            'nilai_penguasaan_ui'             => $request->n4 ? floatval($request->n4) : null,
            'nilai_validasi_output'           => $request->n5 ? floatval($request->n5) : null,
            'total'                           => floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4) + floatval($request->n5),
            'tanggal'                         => $request->tanggal,
            'waktu'                           => $request->waktu,
        ]);

        return redirect('/admin/daftar_nilai_uji_program')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_uji_program(Request $request)
    {
        NilaiUjiProgram::where('nim', $request->nim)->delete();
        return redirect('/admin/daftar_nilai_uji_program')->with('status', 'Nilai berhasil dihapus!');
    }

    //2. input nilai IPK
    public function daftar_nilai_IPK()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('nilai_i_p_k_s as n', 'm.nim', '=', 'n.nim')
            ->join('status_akses as s', 'm.nim', 's.nim')
            ->select('m.nama', 'm.nim', 'n.IPK')
            ->orderBy('nim')
            ->where('m.status', 'lulus')
            ->where('s.no_statusAkses', '=', 7)
            ->orderBy('m.nim')
            ->paginate(25);
        //   dd($mahasiswas);
        return view('admin.daftar_nilai_IPK', compact('mahasiswas'));
    }

    public function add_nilai_IPK(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->select('m.nim', 'm.nama')
            ->where('m.nim', $request->nim)
            ->first();
        return view('admin.add_nilai_IPK', compact('data'));
    }

    public function store_nilai_IPK(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9|unique:daftar_nilai_semhas',
            'IPK'        => 'required|numeric'
        ]);

        if (NilaiIPK::where('nim', $request->nim)->count() > 0) {
            return redirect('/admin/daftar_nilai_IPK')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
        } else {
            $n                = new NilaiIPK;
            $n->nim           = $request->nim;
            $n->IPK           = floatval($request->IPK);
            $n->save();

            return redirect('/admin/daftar_nilai_IPK')->with('status', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_IPK(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftjoin('nilai_i_p_k_s as n', 'n.nim', '=', 'm.nim')
            ->select('m.nim', 'm.nama', 'n.IPK')
            ->where('m.nim', $request->nim)
            ->first();
        return view('admin/edit_nilai_IPK', compact('data'));
    }

    public function store_upd_nilai_IPK(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'IPK'        => 'required|numeric',
        ]);

        NilaiIPK::where('nim', $request->nim)->update([
            'nim'                               => $request->nim,
            'IPK'                           => floatval($request->IPK),
        ]);
        return redirect('/admin/daftar_nilai_IPK')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_IPK(Request $request)
    {
        NilaiIPK::where('nim', $request->nim)->delete();
        return redirect('/admin/daftar_nilai_IPK')->with('status', 'Nilai berhasil dihapus!');
    }

    //3. input nilai sidang
    public function daftar_nilai_sidang_meja_hijau()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_sidang as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->join('status_akses as s', 'm.nim', 's.nim')
            ->select('m.nama as nama_mhs', 'm.nim', 'd.nip', 'd.nama', 'n.total')
            ->orderBy('nim')
            ->where('m.status', 'aktif')
            ->where('s.no_statusAkses', '>=', 5)
            ->orderBy('m.nim')
            ->get();
        //   dd($mahasiswas);

        return view('admin.daftar_nilai_sidang', compact('mahasiswas'));
    }

    public function add_nilai_sidang(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('m.nim', $request->nim)
            ->first();
        return view('admin/add_nilai_sidang', compact('data'));
    }

    public function store_nilai_sidang(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric|digits_between:1,25',
            'n2'        => 'nullable|numeric|digits_between:1,25',
            'n3'        => 'nullable|numeric|digits_between:1,25',
            'n4'        => 'nullable|numeric|digits_between:1,25',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        if (NilaiSidangMejaHijau::where('nim', $request->nim)->count() > 0) {
            return redirect('/admin/daftar_nilai_sidang')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
        } else {
            $n1                                  = new NilaiSidangMejaHijau;
            $n1->nim                             = $request->nim;
            $n1->nip                             = $request->nip;
            $n1->sistematika_penulisan           = $request->n1 ? floatval($request->n1) : null;
            $n1->substansi                       = $request->n2 ? floatval($request->n2) : null;
            $n1->kemampuan_menguasai_substansi   = $request->n3 ? floatval($request->n3) : null;
            $n1->kemampuan_mengemukakan_pendapat = $request->n4 ? floatval($request->n4) : null;
            $n1->tanggal                         = $request->tanggal;
            $n1->waktu                           = $request->waktu;
            $n1->save();

            // $status = DB::select("CALL tahapKeempat($request->nim)");
            return redirect('/admin/daftar_nilai_sidang')->with('status', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_sidang(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('daftar_nilai_sidang as n', 'n.nim', '=', 'm.nim')
            ->leftjoin('dosens as d', 'd.nip', '=', 'n.nip')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select(
                'm.nim',
                'm.nama',
                'f.nip_dosbing1',
                'f.nama_dosbing1',
                'f.nip_dosbing2',
                'f.nama_dosbing2',
                'v.nip_dosen_penguji1',
                'v.nama_dosen_penguji1',
                'v.nip_dosen_penguji2',
                'v.nama_dosen_penguji2',
                'n.sistematika_penulisan as n1',
                'n.substansi as n2',
                'n.kemampuan_menguasai_substansi as n3',
                'n.kemampuan_mengemukakan_pendapat as n4',
                'n.total',
                'd.nama as nama_dosen',
                'd.nip',
                'n.tanggal',
                'n.waktu'
            )
            ->where('m.nim', $request->nim)
            ->get();
        return view('admin/edit_nilai_sidang', compact('data'));
    }

    public function store_upd_nilai_sidang(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'n1'        => 'nullable|numeric|digits_between:1,25',
            'n2'        => 'nullable|numeric|digits_between:1,25',
            'n3'        => 'nullable|numeric|digits_between:1,25',
            'n4'        => 'nullable|numeric|digits_between:1,25',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        NilaiSidangMejaHijau::where('nim', $request->nim)->where('nip', $request->nip)->update([
            'sistematika_penulisan'             => $request->n1 ? floatval($request->n1) : null,
            'substansi'                         => $request->n2 ? floatval($request->n2) : null,
            'kemampuan_menguasai_substansi'     => $request->n3 ? floatval($request->n3) : null,
            'kemampuan_mengemukakan_pendapat'   => $request->n4 ? floatval($request->n4) : null,
            'total'                             => floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4),
            'tanggal'                           => $request->tanggal,
            'waktu'                             => $request->waktu,
        ]);


        return redirect('/admin/daftar_nilai_sidang')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_sidang(Request $request)
    {
        NilaiSidangMejaHijau::where('nim', $request->nim)->delete();
        return redirect('/admin/daftar_nilai_sidang')->with('status', 'Nilai berhasil dihapus!');
    }

    // 3. Input Nilai Semhas
    public function daftar_nilai_semhas()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_semhas as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->join('status_akses as s', 'm.nim', 's.nim')
            ->select('m.nama', 'm.nim', 'd.nip', 'd.nama as nama_dsn', 'n.total')
            ->orderBy('nim')
            ->where('m.status', 'aktif')
            ->where('s.no_statusAkses', '>=', 4)
            ->orderBy('m.nim')
            ->paginate(25);
        return view('admin.daftar_nilai_semhas', compact('mahasiswas'));
    }

    public function add_nilai_semhas(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('m.nim', $request->nim)
            ->first();
        // dd($data);
        return view('admin/add_nilai_semhas', compact('data'));
    }

    public function store_nilai_semhas(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric|digits_between:0,3',
            'n2'        => 'nullable|numeric|digits_between:0,10',
            'n3'        => 'nullable|numeric|digits_between:0,15',
            'n4'        => 'nullable|numeric|digits_between:0,25',
            'n5'        => 'nullable|numeric|digits_between:0,35',
            'n6'        => 'nullable|numeric|digits_between:0,2',
            'n7'        => 'nullable|numeric|digits_between:0,10',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);


        if (NilaiSemhas::where('nim', $request->nim)->count() > 0) {
            return redirect('/admin/daftar_nilai_semhas')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
        } else {
            $n1                                 = new NilaiSemhas;
            // $n2                                 = new NilaiSeminarHasil;
            // $n3                                 = new NilaiSeminarHasil;
            // $n4                                 = new NilaiSeminarHasil;

            $n1->nim                             = $request->nim;
            $n1->nip                             = $request->nip;
            $n1->abstrak                         = floatval($request->n1);
            $n1->pendahuluan                     = floatval($request->n2);
            $n1->landasan_teori                  = floatval($request->n3);
            $n1->metodologi                      = floatval($request->n4);
            $n1->implementasi                    = floatval($request->n5);
            $n1->kesimpulan                      = floatval($request->n6);
            $n1->kemampuan_mengemukakan_substansi = floatval($request->n7);
            $n1->total                           = floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4) + floatval($request->n5) + floatval($request->n6) + floatval($request->n7);
            $n1->tanggal                         = $request->tanggal;
            $n1->waktu                           = $request->waktu;
            $n1->save();

            // $status = DB::select("CALL tahapKeempat($request->nim)");
            return redirect('/admin/daftar_nilai_semhas')->with('status', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_semhas(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('daftar_nilai_semhas as n', 'n.nim', '=', 'm.nim')
            ->leftjoin('dosens as d', 'd.nip', '=', 'n.nip')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select(
                'm.nim',
                'm.nama',
                'f.nip_dosbing1',
                'f.nama_dosbing1',
                'f.nip_dosbing2',
                'f.nama_dosbing2',
                'v.nip_dosen_penguji1',
                'v.nama_dosen_penguji1',
                'v.nip_dosen_penguji2',
                'v.nama_dosen_penguji2',
                'n.abstrak as n1',
                'n.pendahuluan as n2',
                'n.landasan_teori as n3',
                'n.metodologi as n4',
                'n.implementasi as n5',
                'n.kesimpulan as n6',
                'n.kemampuan_mengemukakan_substansi as n7',
                'n.total',
                'd.nama as nama_dosen',
                'd.nip',
                'n.tanggal',
                'n.waktu'
            )
            ->where('m.nim', $request->nim)
            ->get();
        // dd($data);
        return view('admin/edit_nilai_semhas', compact('data'));
    }

    public function store_upd_nilai_semhas(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric|digits_between:0,3',
            'n2'        => 'nullable|numeric|digits_between:0,10',
            'n3'        => 'nullable|numeric|digits_between:0,15',
            'n4'        => 'nullable|numeric|digits_between:0,25',
            'n5'        => 'nullable|numeric|digits_between:0,35',
            'n6'        => 'nullable|numeric|digits_between:0,2',
            'n7'        => 'nullable|numeric|digits_between:0,10',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        NilaiSemhas::where('nim', $request->nim)->where('nip', $request->nip)->update([
            'abstrak'                           => floatval($request->n1),
            'pendahuluan'                       => floatval($request->n2),
            'landasan_teori'                    => floatval($request->n3),
            'metodologi'                        => floatval($request->n4),
            'implementasi'                      => floatval($request->n5),
            'kesimpulan'                        => floatval($request->n6),
            'kemampuan_mengemukakan_substansi'  => floatval($request->n7),
            'total'                             => floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4) + floatval($request->n5) + floatval($request->n6) + floatval($request->n7),
            'tanggal'                           => $request->tanggal,
            'waktu'                             => $request->waktu,
        ]);


        return redirect('/admin/daftar_nilai_semhas')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_semhas(Request $request)
    {
        NilaiSeminarHasil::where('nim', $request->nim)->delete();
        return redirect('/admin/daftar_nilai_semhas')->with('status', 'Nilai berhasil dihapus!');
    }
    //END OF FUNGSI UNTUK INPUT NILAI
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
}
