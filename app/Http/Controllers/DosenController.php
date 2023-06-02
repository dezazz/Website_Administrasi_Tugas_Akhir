<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Exum;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Skripsi;
use App\Models\Mahasiswa;
use App\Models\NilaiSemhas;
use App\Models\NilaiSidang;
use App\Models\DosenPenguji;
use App\Models\JadwalSemhas;
use App\Models\JadwalSempro;
use App\Models\JadwalSidang;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BimbinganSemhas;
use App\Models\BimbinganSempro;
use App\Models\BimbinganSidang;
use App\Models\DosenPembimbing;
use App\Models\NilaiUjiProgram;
use App\Models\NilaiSeminarHasil;
use App\Models\NilaiUjiKelayakan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DosenController extends Controller
{

    public $nim;

    public function store_jd_sidang_pegawai(Request $request)
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
        return redirect('/pegawai_prodi/sidang_penjadwalan')->with('success_add_sidang', 'Jadwal sidang berhasil ditambahkan!');
    }

    public function add_jd_sidang_pegawai(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('pegawai_prodi/add_jd_sidang_pegawai', compact('mahasiswa'));
    }

    public function delete_jd_sidang_pegawai(Request $request)
    {
        //ubah status akses
        DB::select("CALL tahapKelima($request->nim)");
        JadwalSidang::where('nim', $request->nim)->delete();
        return redirect('/pegawai_prodi/sidang_penjadwalan')->with('success_delete_sidang', 'Jadwal sidang berhasil dihapus!');
    }

    public function store_new_jd_sidang_pegawai(Request $request)
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
        return redirect('/pegawai_prodi/sidang_penjadwalan')->with('success_edit_sidang', 'Jadwal sidang berhasil diubah!');
    }

    public function edit_jd_sidang_pegawai(Request $request)
    {
        $nama = $request->nama;
        $jadwal = JadwalSidang::where('nim', $request->nim)->select('nim', 'tanggal_sidang', 'waktu', 'tempat')->first();
        return view('pegawai_prodi/edit_jd_sidang_pegawai', compact('nama', 'jadwal'));
    }

    public function cetakJadwalSidang_pegawai(Request $request)
    {
        $tanggal_sidang = $request->tanggal_sidang;

        $query = DB::table('jdsidangmejahijau as js')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_sidang', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_sidang', '=', $tanggal_sidang)
            ->get();

        return view('admin.berkas.pesertaSidang', compact('query'));
    }

    public function cetakUndanganSidang_pegawai(Request $request)
    {
        $tanggal_sidang = $request->tanggal_sidang;

        $query = DB::table('jdsidangmejahijau as js')->select('js.waktu', 'js.tanggal_sidang', 'js.tempat')
            ->where('js.tanggal_sidang', '=', $tanggal_sidang)->get();
        return view('admin.berkas.undangan_sidang', compact('query'));
    }

    public function sidang_penjadwalan()
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
        $query = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sidangs as js', 'm.nim', '=', 'js.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_sidang', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif')
            ->where('s.no_statusAkses', '=', 5)
            ->orWhere('s.no_statusAkses', '=', 6)
            ->distinct()->orderBy('tanggal_sidang', 'ASC')
            ->get();
        // $query = DB::table('mahasiswas as m')
        // ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
        //     ->leftJoin('jadwal_sempros as js', 'm.nim', '=', 'js.nim')
        //     ->select('m.nim', 'm.nama', 'js.tanggal_sempro', 'js.waktu', 'js.tempat')
        //     ->where('m.status', '=', 'aktif', 'and', 'js.tanggal_sempro', '!=', 'null')
        //     ->where('s.no_statusAkses', '=', 1)
        //     ->orWhere('s.no_statusAkses', '=', 2)
        //     ->distinct()->orderBy('tanggal_sempro', 'ASC')
        //     ->get();
        return view('pegawai_prodi/sidang_penjadwalan', compact('mahasiswas', 'query'));
    }

    public function store_jd_semhas_pegawai(Request $request)
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
            return redirect('/pegawai_prodi/semhas_penjadwalan')->with('success_add_semhas', 'Jadwal Seminar Hasil berhasil ditambahkan');
        } else {
            return redirect('/pegawai_prodi/semhas_penjadwalan')->with('failed_add_semhas', 'Jadwal Seminar Gagal ditambahkan');
        }
    }

    public function add_jd_semhas_pegawai(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('pegawai_prodi/add_jd_semhas_pegawai', compact('mahasiswa'));
    }

    public function delete_jd_semhas_pegawai(Request $request)
    {
        //ubah status akses
        DB::select("CALL tahapKetiga($request->nim)");
        JadwalSemhas::where('nim', $request->nim)->delete();
        return redirect('/pegawai_prodi/semhas_penjadwalan')->with('success_delete_semhas', 'Jadwal seminar hasil berhasil dihapus!');
    }

    public function store_new_jd_semhas_pegawai(Request $request)
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

        return redirect('/pegawai_prodi/semhas_penjadwalan')->with('success_edit_semhas', 'Jadwal seminar hasil berhasil diubah!');
    }

    public function edit_jd_semhas_pegawai(Request $request)
    {
        $nama = $request->nama;
        $jadwal = JadwalSemhas::where('nim', $request->nim)->select('nim', 'tanggal_semhas', 'waktu', 'tempat')->first();
        return view('pegawai_prodi/edit_jd_semhas_pegawai', compact('nama', 'jadwal'));
    }

    public function cetakJadwalSemhas_pegawai(Request $request)
    {
        $tanggal_semhas = $request->tanggal_semhas;

        $query = DB::table('v_jdSemhas as js')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_semhas', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_semhas', '=', $tanggal_semhas)
            ->get();

        return view('admin.berkas.pesertaSemhas', compact('query'));
    }

    public function cetakUndanganSemhas_pegawai(Request $request)
    {
        $tanggal_semhas = $request->tanggal_semhas;

        $query = DB::table('v_jdSemhas as js')
            ->where('js.tanggal_semhas', '=', $tanggal_semhas)
            ->get();

        return view('admin.berkas.undangan_semhas', compact('query'));
    }

    public function semhas_penjadwalan()
    {
        // $query = DB::table('mahasiswas as m')
        // ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
        // ->leftJoin('jadwal_sempros as js', 'm.nim', '=', 'js.nim')
        // ->select('m.nim', 'm.nama', 'js.tanggal_sempro', 'js.waktu', 'js.tempat')
        // ->where('m.status', '=', 'aktif', 'and', 'js.tanggal_sempro', '!=', 'null')
        // ->where('s.no_statusAkses', '=', 1)
        // ->orWhere('s.no_statusAkses', '=', 2)
        // ->distinct()->orderBy('tanggal_sempro', 'ASC')
        // ->get();
        $query = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_semhas as js', 'm.nim', '=', 'js.nim')
            ->leftJoin('skripsis as sk', 'm.nim', '=', 'sk.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_semhas', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif', 'and', 'js.tanggal_semhas', '!=', 'null')
            ->where('s.no_statusAkses', '=', 3)
            ->orWhere('s.no_statusAkses', '=', 4)
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
        return view('pegawai_prodi/semhas_penjadwalan', compact('mahasiswas', 'query'));
    }

    public function store_jd_sempro_pegawai(Request $request)
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
            return redirect('/pegawai_prodi/sempro_penjadwalan')->with('success_add_sempro', 'Jadwal Seminar Proposal berhasil ditambahkan!');
        } else {
            return redirect('/pegawai_prodi/sempro_penjadwalan')->with('success_add_sempro', 'Jadwal Seminar Proposal berhasil ditambahkan! Daftarkan data skripsi agar mahasiswa dapat melanjutkan proses administrasi.');
        }
    }

    public function delete_jd_sempro_pegawai(Request $request)
    {
        DB::select("CALL tahapPertama($request->nim)");
        JadwalSempro::where('nim', $request->nim)->delete();
        return redirect('/pegawai_prodi/sempro_penjadwalan')->with('success_delete_jd_sempro', 'Jadwal seminar proposal berhasil dihapus!');
    }

    public function store_new_jd_sempro_pegawai(Request $request)
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

        return redirect('/pegawai_prodi/sempro_penjadwalan')->with('success_edit_jd_sempro', 'Jadwal seminar proposal berhasil diubah!');
    }

    public function add_jd_sempro_pegawai(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas as m')
            ->where('nim', $request->nim)
            ->select('m.nim', 'm.nama')
            ->first();
        return view('pegawai_prodi/add_jd_sempro_pegawai', compact('mahasiswa'));
    }

    public function edit_jd_sempro_pegawai(Request $request)
    {
        // return 'Edit Jadwal Sempro pegawai';
        $nama = $request->nama;
        $jadwal = JadwalSempro::where('nim', $request->nim)->select('nim', 'tanggal_sempro', 'waktu', 'tempat')->first();
        return view('pegawai_prodi/edit_jd_sempro_pegawai', compact('nama', 'jadwal'));
    }

    public function cetakJadwalSempro_pegawai(Request $request)
    {
        $tanggal_sempro = $request->tanggal_sempro;

        $query = DB::table('v_jdSempro as js')
            ->where('js.tanggal_sempro', '=', $tanggal_sempro)
            ->get();

        return view('admin.berkas.pesertaSempro', compact('query'));
    }

    //INI MON
    public function cetakUndanganSempro_pegawai(Request $request)
    {
        $tanggal_sempro = $request->tanggal_sempro;

        $query = DB::table('v_jdSempro as js')
            ->where('js.tanggal_sempro', '=', $tanggal_sempro)
            ->get();

        return view('admin.berkas.undangan_sempro', compact('query'));
    }

    public function uji_kelayakan_penjadwalan()
    {
        return 'Uji Kelayakan Penjadwalan';
    }

    public function sempro_penjadwalan()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sempros as js', 'm.nim', '=', 'js.nim')
            ->leftJoin('skripsis as sp', 'm.nim', '=', 'sp.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_sempro', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif')
            ->where('s.no_statusAkses', '=', 1)
            ->orWhere('s.no_statusAkses', '=', 2)
            ->orderBy('js.tanggal_sempro', 'DESC')
            ->paginate(12);

        $query = DB::table('mahasiswas as m')
            ->leftJoin('status_akses as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sempros as js', 'm.nim', '=', 'js.nim')
            ->select('m.nim', 'm.nama', 'js.tanggal_sempro', 'js.waktu', 'js.tempat')
            ->where('m.status', '=', 'aktif', 'and', 'js.tanggal_sempro', '!=', 'null')
            ->where('s.no_statusAkses', '=', 1)
            ->orWhere('s.no_statusAkses', '=', 2)
            ->distinct()->orderBy('tanggal_sempro', 'ASC')
            ->get();
        // dd($query);

        return view('pegawai_prodi/sempro_penjadwalan', compact('mahasiswas', 'query'));
    }

    public function pegawai_prodi()
    {
        return view('pegawai_prodi/dashboard');
    }

    public function daftar_exum_ditolak()
    {
        $exum = Exum::where('status', 'Ditolak')->get();
        return view('kepala_laboratorium/daftar_exum_ditolak', compact('exum'));
    }

    public function daftar_exum_diterima()
    {
        $exum = Exum::where('status', 'Disetujui')->get();
        return view('kepala_laboratorium/daftar_exum_diterima', compact('exum'));
    }

    public function kepala_lab_exum_setujui($nim)
    {
        $exum = Exum::where('nim', $nim)->first();
        $exum_terima = DB::table('exums')->where('nim', $nim)->update(['status' => 'Disetujui']);
        if ($exum_terima) {
            return redirect()->route('kepala_lab_exum')->with('success_terima_exum', 'Exum Mahasiswa ' . $exum->nama_mhs . ' Disetujui');
        } else {
            return redirect()->route('kepala_lab_exum')->with('error_terima_exum', 'Data Gagal Diupdate');
        }
    }

    public function kepala_lab_exum_tolak($nim)
    {
        $exum = Exum::where('nim', $nim)->first();
        $exum_tolak = DB::table('exums')->where('nim', $nim)->update(['status' => 'Ditolak']);
        if ($exum_tolak) {
            return redirect()->route('kepala_lab_exum')->with('success_tolak_exum', 'Exum Mahasiswa ' . $exum->nama_mhs . ' Ditolak');
        } else {
            return redirect()->route('kepala_lab_exum')->with('error_tolak_exum', 'Data Gagal Diupdate');
        }
    }

    public function kepala_lab_exum_download($nim)
    {
        $exum = Exum::where('nim', $nim)->first();
        // download exum file from storage/app/exum folder
        $file = storage_path('/app/public/exums/' . $exum->file_exum);
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, $exum->file_exum, $headers);
    }

    public function kepala_lab_exum()
    {
        $exum = Exum::where('status', 'Belum Diperiksa')->get();
        return view('kepala_laboratorium/kepala_lab_exum', compact('exum'));
    }

    public function kepala_laboratorium()
    {
        return view('kepala_laboratorium/dashboard');
    }

    public function penguji_nilai_uji_kelayakan()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pengujis.nip_penguji1', '=', Auth::user()->username)
            ->get();
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('v.nip_dosen_penguji1', '=', Auth::user()->username)
            ->orWhere('v.nip_dosen_penguji2', '=', Auth::user()->username)
            ->get();
        return view('dosen_penguji/penguji_nilai_uji_kelayakan', compact('data', 'mahasiswa'));
    }

    public function store_nilai_uji_kelayakan_penguji(Request $request)
    {
        //-- 1	Judul Skripsi enum(terima, perbaiki, ganti)
        //--  catatan_judul_skripsi text
        //-- 2	Latar Belakang enum(terima, perbaiki, ganti)
        //--  catatan_latar_belakang text
        //-- 3	Rumusan Masalah enum(terima, perbaiki, ganti)
        //-- catatan_rumusan_masalah text
        //-- 4	Landasan Teori enum(terima, perbaiki, ganti)
        //-- catatan_landasan_teoris text
        //-- 5	Penelitian Terdahulu enum(terima, perbaiki, ganti)
        //-- catatan_penelitian_terdahulu text
        //-- 6	Data yang Digunakan enum(terima, perbaiki, ganti)
        //-- catatan_data_yang_digunakan text
        //-- 7	Metodologi (Arsitektur Umum) enum(terima, perbaiki, ganti)
        //-- catatan_metodologi text
        //-- 8	Daftar Pustaka ) enum(terima, perbaiki, ganti)
        //-- catatan_daftar_pustaka text

        $n1                                 = new NilaiUjiKelayakan;
        $n1->nim                            = $request->nim;
        $n1->nip                            = Auth::user()->username;
        $n1->judul_skripsi                  = $request->n1;
        $n1->catatan_judul_skripsi          = $request->catatan_judul_skripsi;
        $n1->latar_belakang                 = $request->n2;
        $n1->catatan_latar_belakang         = $request->catatan_latar_belakang;
        $n1->rumusan_masalah                = $request->n3;
        $n1->catatan_rumusan_masalah        = $request->catatan_rumusan_masalah;
        $n1->landasan_teori                 = $request->n4;
        $n1->catatan_landasan_teoris        = $request->catatan_landasan_teoris;
        $n1->penelitian_terdahulu           = $request->n5;
        $n1->catatan_penelitian_terdahulu   = $request->catatan_penelitian_terdahulu;
        $n1->data_yang_digunakan            = $request->n6;
        $n1->catatan_data_yang_digunakan    = $request->catatan_data_yang_digunakan;
        $n1->metodologi                     = $request->n7;
        $n1->catatan_metodologi             = $request->catatan_metodologi;
        $n1->daftar_pustaka                 = $request->n8;
        $n1->catatan_daftar_pustaka         = $request->catatan_daftar_pustaka;
        $n1->tanggal                        = $request->tanggal;
        $n1->waktu                          = $request->waktu;
        $n1->save();

        if ($n1) {
            return redirect('penguji/penguji_nilai_uji_kelayakan')->with('success_uji_kelayakan', 'Data Nilai Uji Kelayakan Proposal Berhasil Disimpan');
        } else {
            return redirect('penguji/penguji_nilai_uji_kelayakan')->with('error_uji_kelayakan', 'Data Nilai Uji Kelayakan Proposal Gagal Disimpan');
        }
    }

    public function penguji_nilai_semhas()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pengujis.nip_penguji1', '=', Auth::user()->username)
            ->get();
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('v.nip_dosen_penguji1', '=', Auth::user()->username)
            ->orWhere('v.nip_dosen_penguji2', '=', Auth::user()->username)
            ->get();
        return view('dosen_penguji/penguji_nilai_semhas', compact('data', 'mahasiswa'));
    }

    public function store_nilai_semhas_penguji(Request $request)
    {
        $n1                                 = new NilaiSemhas;
        $n1->nim                             = $request->nim;
        $n1->nip                             = Auth::user()->username;
        $n1->abstrak                         = floatval($request->n1);
        $n1->pendahuluan                     = floatval($request->n2);
        $n1->landasan_teori                  = floatval($request->n3);
        $n1->metodologi                      = floatval($request->n4);
        $n1->implementasi                    = floatval($request->n5);
        $n1->kesimpulan                      = floatval($request->n6);
        $n1->kemampuan_mengemukakan_substansi = floatval($request->n7);
        $n1->tanggal                         = $request->tanggal;
        $n1->save();

        if ($n1) {
            return redirect('penguji/penguji_nilai_semhas')->with('success_nilai_semhas', 'Nilai Seminar Hasil Berhasil Ditambahkan');
        } else {
            return redirect('penguji/penguji_nilai_semhas')->with('error_nilai_semhas', 'Nilai Seminar Hasil Gagal Ditambahkan');
        }
    }

    public function penguji_nilai_sidang()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pengujis.nip_penguji1', '=', Auth::user()->username)
            ->orWhere('dosen_pengujis.nip_penguji2', '=', Auth::user()->username)
            ->get();
        return view('dosen_penguji/penguji_nilai_sidang', compact('mahasiswa'));
    }

    public function store_nilai_sidang_penguji(Request $request)
    {
        // return $request->all();
        $n1                                  = new NilaiSidang;
        $n1->nim                             = $request->nim;
        $n1->nip                             = Auth::user()->username;
        $n1->sistematika_penulisan           = $request->n1 ? floatval($request->n1) : null;
        $n1->substansi                       = $request->n2 ? floatval($request->n2) : null;
        $n1->kemampuan_menguasai_substansi   = $request->n3 ? floatval($request->n3) : null;
        $n1->kemampuan_mengemukakan_pendapat = $request->n4 ? floatval($request->n4) : null;
        $n1->tanggal                         = $request->tanggal;
        $n1->waktu                           = $request->waktu;
        $n1->save();

        if ($n1) {
            return redirect('penguji/penguji_nilai_sidang')->with('success_nilai_sidang', 'Nilai Sidang Berhasil Ditambahkan');
        } else {
            return redirect('penguji/penguji_nilai_sidang')->with('error_nilai_sidang', 'Nilai Sidang Gagal Ditambahkan');
        }
    }

    public function jadwal_kelayakan_isi_proposal()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('jadwal_uji_kelayakans')
            ->join('mahasiswas', 'jadwal_uji_kelayakans.nim', '=', 'mahasiswas.nim')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->join('skripsis', 'mahasiswas.nim', '=', 'skripsis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama', 'jadwal_uji_kelayakans.tanggal', 'jadwal_uji_kelayakans.waktu', 'jadwal_uji_kelayakans.tempat', 'skripsis.judul_skripsi')
            ->where('dosen_pengujis.nip_penguji1', '=', $nip->nip)
            ->orWhere('dosen_pengujis.nip_penguji2', '=', $nip->nip)
            ->get();

        return view('dosen_penguji.jadwal_kelayakan_isi_proposal', compact('query'));
    }

    public function jadwal_semhas_penguji()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('jadwal_semhas')
            ->join('mahasiswas', 'jadwal_semhas.nim', '=', 'mahasiswas.nim')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->join('skripsis', 'mahasiswas.nim', '=', 'skripsis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama', 'jadwal_semhas.tanggal_semhas', 'jadwal_semhas.waktu', 'jadwal_semhas.tempat', 'skripsis.judul_skripsi')
            ->where('dosen_pengujis.nip_penguji1', '=', $nip->nip)
            ->orWhere('dosen_pengujis.nip_penguji2', '=', $nip->nip)
            ->get();

        return view('dosen_penguji.jadwal_semhas_penguji', compact('query'));
    }

    public function jadwal_sidang_penguji()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('jadwal_sidangs')
            ->join('mahasiswas', 'jadwal_sidangs.nim', '=', 'mahasiswas.nim')
            ->join('dosen_pengujis', 'mahasiswas.nim', '=', 'dosen_pengujis.nim')
            ->join('skripsis', 'mahasiswas.nim', '=', 'skripsis.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama', 'jadwal_sidangs.tanggal_sidang', 'jadwal_sidangs.waktu', 'jadwal_sidangs.tempat', 'skripsis.judul_skripsi')
            ->where('dosen_pengujis.nip_penguji1', '=', $nip->nip)
            ->orWhere('dosen_pengujis.nip_penguji2', '=', $nip->nip)
            ->get();

        return view('dosen_penguji.jadwal_sidang_penguji', compact('query'));
    }

    public function detail_mahasiswa_penguji($nim)
    {
        $query = DB::table('v_detail_mhs')->where('nim', $nim)->get();
        // $query = collect($query);
        // dd($query);

        // $progres = DB::table('v_progress_skripsi')->where('nim', $nim)
        //     ->select('persentase_skripsi', 'keterangan')
        //     ->get();

        return view('dosen_penguji.detail_mahasiswa_penguji', compact('query'));
    }

    public function daftar_mahasiswa_penguji()
    {
        // $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        // $nim = DB::table('v_dosen_penguji')
        //     ->select('nim')
        //     ->where('nip_dosen_penguji1', '=', Auth::user()->username)
        //     ->orWhere('nip_dosen_penguji2', '=', Auth::user()->username)
        //     ->get();

        // Ubah nim ke string array
        // $nim = json_decode($nim, true);
        // $nim = array_column($nim, 'nim');

        $mahasiswa = DB::table('v_dosen_penguji as d')
            ->select('d.nim', 'd.nama_mhs')
            ->where('nip_dosen_penguji1', '=', Auth::user()->username)
            ->orWhere('nip_dosen_penguji2', '=', Auth::user()->username)
            ->get();

        return view('dosen_penguji.daftar_mahasiswa_penguji', compact('mahasiswa'));
    }

    public function v_nilai_uji_program()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        return view('dosen/v_nilai_uji_program', compact('mahasiswa'));
    }
    public function v_nilai_semhas()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('f.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('f.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        // dd($data);
        return view('dosen/v_nilai_semhas', compact('data', 'mahasiswa'));
    }
    public function v_nilai_sidang(Request $request)
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        return view('dosen/v_nilai_sidang', compact('mahasiswa'));
    }

    public function store_nilai_uji_program(Request $request)
    {
        // $request->validate([
        //     'nim' => 'required',
        //     'nilai' => 'required',
        // ]);
        // dd($request->all());
        $check_duplicate = NilaiUjiProgram::where('nim', $request->nim)->first();
        if ($check_duplicate != NULL) {
            return redirect()->route('v_nilai_uji_program')->with('error_nilai_uji_program', 'Nilai Uji Program Mahasiswa ini Sudah Ada');
        } else {
            $n                                  = new NilaiUjiProgram;
            $n->nim                             = $request->nim;
            $n->nip                             = Auth::user()->username;
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
            $n->waktu                           = $request->waktu ?? NULL;
            $n->save();
        }
        if ($n) {
            return redirect()->route('v_nilai_uji_program')->with('success_nilai_uji_program', 'Nilai Uji Program Berhasil Ditambahkan');
        } else {
            return redirect()->route('v_nilai_uji_program')->with('error_nilai_uji_program', 'Nilai Uji Program Gagal Ditambahkan');
        }
    }

    public function store_nilai_semhas(Request $request)
    {
        // dd($request->nim);
        $check_duplicate = NilaiSemhas::where('nim', $request->nim)->first();
        if ($check_duplicate != NULL) {
            return redirect('dosen/v_nilai_semhas')->with('error_nilai_semhas', 'Nilai Seminar Hasil mahasiswa ini Sudah Ada');
        } else {
            $n1                                 = new NilaiSemhas;
            $n1->nim                             = $request->nim;
            $n1->nip                             = Auth::user()->username;
            $n1->abstrak                         = floatval($request->n1);
            $n1->pendahuluan                     = floatval($request->n2);
            $n1->landasan_teori                  = floatval($request->n3);
            $n1->metodologi                      = floatval($request->n4);
            $n1->implementasi                    = floatval($request->n5);
            $n1->kesimpulan                      = floatval($request->n6);
            $n1->kemampuan_mengemukakan_substansi = floatval($request->n7);
            $n1->tanggal                         = $request->tanggal;
            $n1->waktu                           = $request->waktu ?? NULL;
            $n1->save();
        }
        if ($n1) {
            return redirect('dosen/v_nilai_semhas')->with('success_nilai_semhas', 'Nilai Seminar Hasil Berhasil Ditambahkan');
        } else {
            return redirect('dosen/v_nilai_semhas')->with('error_nilai_semhas', 'Nilai Seminar Hasil Gagal Ditambahkan');
        }
    }

    public function store_nilai_sidang_dosen(Request $request)
    {
        $check_duplicate = NilaiSidang::where('nim', $request->nim)->first();
        if ($check_duplicate != NULL) {
            return redirect('dosen/v_nilai_sidang')->with('error_nilai_sidang', 'Nilai Sidang mahasiswa ini Sudah Ada');
        } else {
            $n1                                  = new NilaiSidang;
            $n1->nim                             = $request->nim;
            $n1->nip                             = Auth::user()->username;
            $n1->sistematika_penulisan           = $request->n1 ? floatval($request->n1) : null;
            $n1->substansi                       = $request->n2 ? floatval($request->n2) : null;
            $n1->kemampuan_menguasai_substansi   = $request->n3 ? floatval($request->n3) : null;
            $n1->kemampuan_mengemukakan_pendapat = $request->n4 ? floatval($request->n4) : null;
            $n1->tanggal                         = $request->tanggal;
            $n1->waktu                           = $request->waktu;
            $n1->save();
        }
        if ($n1) {
            return redirect('dosen/v_nilai_sidang')->with('success_nilai_sidang', 'Nilai Sidang Berhasil Ditambahkan');
        } else {
            return redirect('dosen/v_nilai_sidang')->with('error_nilai_sidang', 'Nilai Sidang Gagal Ditambahkan');
        }
    }


    public function mhs_bimbingan()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $nim = DB::table('dosen_pembimbings')
            ->select('nim')
            ->where('nip_dosbing1', '=', $nip->nip)
            ->orWhere('nip_dosbing2', '=', $nip->nip)
            ->get();
        // Ubah nim ke string array
        $nim = json_decode($nim, true);
        $nim = array_column($nim, 'nim');
        // dd($nim);
        // keterangan -> v_progress_skripsi
        // nama_mhs -> v_mhs_bimbingan
        // $mahasiswa = DB::table('v_mhs_bimbingan')
        //     ->join('v_progress_skripsi', 'v_mhs_bimbingan.nim', '=', 'v_progress_skripsi.nim')
        //     ->select('v_mhs_bimbingan.nim', 'v_mhs_bimbingan.nama_mhs', 'v_progress_skripsi.keterangan')
        //     ->where('v_mhs_bimbingan.nip', '=', Auth::user()->username)
        //     ->get();
        $mahasiswa = DB::table('v_mhs_bimbingan')
            ->select('v_mhs_bimbingan.nim', 'v_mhs_bimbingan.nama_mhs')
            ->where('v_mhs_bimbingan.nip', '=', Auth::user()->username)
            ->get();
        // $mahasiswa = DB::table('dosen_pembimbings as d')
        //     ->join('mahasiswas as mhs', 'd.nim', '=', 'mhs.nim ')
        //     ->join('v_progress_skripsi as p', 'd.nim', '=', 'p.nim')
        //     ->select('d.nim', 'mhs.nama as nama_mhs', 'p.keterangan')
        //     ->whereIn('d.nim', $nim)
        //     ->get();


        return view('dosen/mhs_bimbingan', compact('mahasiswa'));
    }

    public function bimbingan_sempro()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        return view('dosen.bimbingan_sempro', compact('mahasiswa'));
    }

    public function simpan_bimbingan_sempro(Request $request)
    {

        // $request->validate([
        //     'nim' => 'required',
        //     'tanggal' => 'required',
        //     'jam' => 'required',
        //     'tempat' => 'required',
        //     'topik' => 'required',
        //     'catatan' => 'required',
        // ]);
        // nim 	nip 	tgl_penyerahan 	tgl_selesai_periksa 	tgl_kembali 	catatan
        $bimbingan_sempro = new BimbinganSempro;
        $bimbingan_sempro->nim = $request->nim;
        $bimbingan_sempro->nip = Auth::user()->username;
        $bimbingan_sempro->tgl_penyerahan = $request->tanggalPenyerahan;
        $bimbingan_sempro->tgl_selesai_periksa = $request->tanggalSelesaiDiperiksa;
        $bimbingan_sempro->tgl_kembali = $request->tanggalDiterimaKembali;
        $bimbingan_sempro->catatan = $request->catatan;
        $bimbingan_sempro->save();

        if ($bimbingan_sempro) {
            return redirect()->route('bimbingan_sempro')->with('success_bimbingan_sempro', 'Data Bimbingan Seminar Proposal Berhasil Ditambahkan');
        } else {
            return redirect()->route('bimbingan_sempro')->with('error_bimbingan_sempro', 'Data Bimbingan Seminar Proposal Gagal Ditambahkan');
        }
    }


    public function bimbingan_semhas()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        return view('dosen.bimbingan_semhas', compact('mahasiswa'));
    }

    public function simpan_bimbingan_semhas(Request $request)
    {
        $bimbingan_semhas = new BimbinganSemhas;
        $bimbingan_semhas->nim = $request->nim;
        $bimbingan_semhas->nip = Auth::user()->username;
        $bimbingan_semhas->tgl_penyerahan = $request->tanggalPenyerahan;
        $bimbingan_semhas->tgl_selesai_periksa = $request->tanggalSelesaiDiperiksa;
        $bimbingan_semhas->tgl_kembali = $request->tanggalDiterimaKembali;
        $bimbingan_semhas->catatan = $request->catatan;
        $bimbingan_semhas->save();

        if ($bimbingan_semhas) {
            return redirect()->route('bimbingan_semhas')->with('success_bimbingan_semhas', 'Data Bimbingan Seminar Hasil Berhasil Ditambahkan');
        } else {
            return redirect()->route('bimbingan_semhas')->with('error_bimbingan_semhas', 'Data Bimbingan Seminar Hasil Gagal Ditambahkan');
        }
    }


    public function bimbingan_sidang()
    {
        $mahasiswa = DB::table('mahasiswas')
            ->join('dosen_pembimbings', 'mahasiswas.nim', '=', 'dosen_pembimbings.nim')
            ->select('mahasiswas.nim', 'mahasiswas.nama')
            ->where('dosen_pembimbings.nip_dosbing1', '=', Auth::user()->username)
            ->orWhere('dosen_pembimbings.nip_dosbing2', '=', Auth::user()->username)
            ->get();
        return view('dosen.bimbingan_sidang', compact('mahasiswa'));
    }

    public function simpan_bimbingan_sidang(Request $request)
    {
        $bimbingan_sidang = new BimbinganSidang;
        $bimbingan_sidang->nim = $request->nim;
        $bimbingan_sidang->nip = Auth::user()->username;
        $bimbingan_sidang->tgl_penyerahan = $request->tanggalPenyerahan;
        $bimbingan_sidang->tgl_selesai_periksa = $request->tanggalSelesaiDiperiksa;
        $bimbingan_sidang->tgl_kembali = $request->tanggalDiterimaKembali;
        $bimbingan_sidang->catatan = $request->catatan;
        $bimbingan_sidang->save();

        if ($bimbingan_sidang) {
            return redirect()->route('bimbingan_sidang')->with('success_bimbingan_sidang', 'Data Bimbingan Sidang Berhasil Ditambahkan');
        } else {
            return redirect()->route('bimbingan_sidang')->with('error_bimbingan_sidang', 'Data Bimbingan Sidang Gagal Ditambahkan');
        }
    }

    public function berkasBeritaAcara($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $query = DB::table('dosens')
            ->select('nama', 'nip')
            ->whereNotIn('nip', (function ($query) {
                $query->from('dosen_pembimbings')
                    ->select('nip_dosbing2')
                    ->where('nim', '=', function ($query) {
                        $query->from('mahasiswas')
                            ->select('nim')
                            ->where('nim', '=', $this->nim);
                    });
            }))
            ->get();

        $skripsi = DB::table('skripsis')
            ->select('judul_skripsi', 'bidang_ilmu')
            ->where('nim', '=', function ($skripsi) {
                $skripsi->from('mahasiswas')
                    ->select('nim')
                    ->where('nim', '=', $this->nim);
            })->get();
        return view('dosen.berkas.beritaAcaraSempro', compact('mahasiswa', 'query', 'skripsi'));
    }

    public function berkasPenilaianSempro($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $query = DB::table('dosens')
            ->select('nama', 'nip')
            ->whereNotIn('nip', (function ($query) {
                $query->from('dosen_pembimbings')
                    ->select('nip_dosbing2')
                    ->where('nim', '=', function ($query) {
                        $query->from('mahasiswas')
                            ->select('nim')
                            ->where('nim', '=', $this->nim);
                    });
            }))
            ->get();

        $skripsi = DB::table('skripsis')
            ->select('judul_skripsi', 'bidang_ilmu')
            ->where('nim', '=', function ($skripsi) {
                $skripsi->from('mahasiswas')
                    ->select('nim')
                    ->where('nim', '=', $this->nim);
            })->get();

        $nilai_kelayakan = DB::table('nilai_uji_kelayakans')->where('nim', $nim)->get();
        return view('dosen.berkas.penilaianKelayakanSempro', compact('mahasiswa', 'query', 'skripsi', 'nilai_kelayakan'));
    }

    public function berkasPersetujuanSemhas($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $query = DB::table('dosens')
            ->select('nama', 'nip')
            ->whereNotIn('nip', (function ($query) {
                $query->from('dosen_pembimbings')
                    ->select('nip_dosbing2')
                    ->where('nim', '=', function ($query) {
                        $query->from('mahasiswas')
                            ->select('nim')
                            ->where('nim', '=', $this->nim);
                    });
            }))
            ->get();

        $skripsi = DB::table('skripsis')
            ->select('judul_skripsi', 'bidang_ilmu')
            ->where('nim', '=', function ($skripsi) {
                $skripsi->from('mahasiswas')
                    ->select('nim')
                    ->where('nim', '=', $this->nim);
            })->get();

        return view('dosen.berkas.persetujuanSemhas', compact('mahasiswa', 'query', 'skripsi'));
    }

    public function berkasBeritaAcaraSemhas($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $query = DB::table('dosens')
            ->select('nama', 'nip')
            ->whereNotIn('nip', (function ($query) {
                $query->from('dosen_pembimbings')
                    ->select('nip_dosbing2')
                    ->where('nim', '=', function ($query) {
                        $query->from('mahasiswas')
                            ->select('nim')
                            ->where('nim', '=', $this->nim);
                    });
            }))
            ->get();

        $skripsi = DB::table('skripsis')
            ->select('judul_skripsi', 'bidang_ilmu')
            ->where('nim', '=', function ($skripsi) {
                $skripsi->from('mahasiswas')
                    ->select('nim')
                    ->where('nim', '=', $this->nim);
            })->get();

        return view('dosen.berkas.beritaAcaraSemhas', compact('mahasiswa', 'query', 'skripsi'));
    }

    public function berkasPersetujuanSidang($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        $query = DB::table('dosens')
            ->select('nama', 'nip')
            ->whereNotIn('nip', (function ($query) {
                $query->from('dosen_pembimbings')
                    ->select('nip_dosbing2')
                    ->where('nim', '=', function ($query) {
                        $query->from('mahasiswas')
                            ->select('nim')
                            ->where('nim', '=', $this->nim);
                    });
            }))
            ->get();

        $skripsi = DB::table('skripsis')
            ->select('judul_skripsi', 'bidang_ilmu')
            ->where('nim', '=', function ($skripsi) {
                $skripsi->from('mahasiswas')
                    ->select('nim')
                    ->where('nim', '=', $this->nim);
            })->get();

        return view('dosen.berkas.persetujuanSidang', compact('mahasiswa', 'query', 'skripsi'));
    }

    public function berkasKataPengantarSidang($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        return view('dosen.berkas.kataPengantarSidang', compact('mahasiswa'));
    }

    public function berkasBeritaAcaraSidang($nim)
    {
        $this->nim = $nim;
        $mahasiswa = Mahasiswa::findOrFail($nim);

        return view('dosen.berkas.beritaAcaraSidang', compact('mahasiswa'));
    }

    public function index()
    {
        return view('dosen.dashboard');
    }

    public function penguji()
    {
        return view('dosen_penguji.dashboard');
    }

    //INI MON
    public function mahasiswaTA()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $mahasiswa = DB::table('v_progress_skripsi as ps')
            ->join('v_mhs_bimbingan as db', 'ps.nim', '=', 'db.nim')
            ->join('status_akses as sk', 'ps.nim', '=', 'sk.nim')
            ->select('db.nama_mhs', 'db.nim', 'ps.persentase_skripsi', 'ps.keterangan')
            ->where('nip', $nip->nip)->where('sk.no_statusAkses', '<', '7')
            ->get();

        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        // dd($mahasiswa);
        return view('dosen.mahasiswaBimbingan-dosen', compact('mahasiswa', 'angkatan'));
    }

    public function mahasiswaLulus()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $mahasiswa = DB::table('v_progress_skripsi as ps')
            ->join('v_mhs_bimbingan as db', 'ps.nim', '=', 'db.nim')
            ->join('mahasiswas as m', 'ps.nim', '=', 'm.nim')
            ->select('db.nama_mhs', 'db.nim')
            ->where('nip', $nip->nip)->where('m.status', '=', 'Lulus')
            ->get();
        // dd($mahasiswa);
        return view('dosen.mahasiswaBimbinganLulus-dosen', compact('mahasiswa'));
    }

    //INI MON
    public function detailMahasiswa($nim)
    {
        $query = DB::table('v_detail_mhs')->where('nim', $nim)->get();
        // $query = collect($query);
        // dd($query);

        $progres = DB::table('v_progress_skripsi')->where('nim', $nim)
            ->select('persentase_skripsi', 'keterangan')
            ->get();
        return view('dosen.layoutMahasiswadetail', compact('query', 'progres'));
    }
    public function search_mhs_lulus(Request $request)
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $mahasiswa = DB::table('v_progress_skripsi as ps')
            ->join('v_mhs_bimbingan as db', 'ps.nim', '=', 'db.nim')
            ->join('mahasiswas as m', 'ps.nim', '=', 'm.nim')
            ->select('db.nama_mhs', 'db.nim')
            ->where('nip', $nip->nip)->where('m.status', '=', 'Lulus')
            ->where('db.nama_mhs', 'like', "%" . $request->keyword . "%")->where('nip', $nip->nip)
            ->orWhere('db.nim', 'like', "%" . $request->keyword . "%")->where('nip', $nip->nip)
            ->paginate(25);

        $counter = $mahasiswa->count();
        // dd($counter);

        return view('dosen/hasil_pencarian_lulus', compact('mahasiswa', 'counter'));
    }

    public function search_mhs_aktif(Request $request)
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $mahasiswa = DB::table('v_progress_skripsi as ps')
            ->join('v_mhs_bimbingan as db', 'ps.nim', '=', 'db.nim')
            ->join('status_akses as sk', 'ps.nim', '=', 'sk.nim')
            ->select('db.nama_mhs', 'db.nim', 'ps.persentase_skripsi', 'ps.keterangan')
            ->where('nip', $nip->nip)->where('sk.no_statusAkses', '<', '7')
            ->where('ps.keterangan', 'like', "%" . $request->keyword . "%")
            ->orWhere('ps.persentase_skripsi', 'like', "%" . $request->keyword . "%")->where('nip', $nip->nip)
            ->orWhere('db.nama_mhs', 'like', "%" . $request->keyword . "%")->where('nip', $nip->nip)
            ->orWhere('db.nim', 'like', "%" . $request->keyword . "%")->where('nip', $nip->nip)
            ->get();
        // dd($mahasiswa);

        $counter = $mahasiswa->count();

        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();

        return view('dosen/hasil_pencarian_aktif', compact('mahasiswa', 'counter', 'angkatan'));
    }

    public function filter(Request $request)
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $mahasiswa = DB::table('v_progress_skripsi as ps')
            ->join('v_mhs_bimbingan as db', 'ps.nim', '=', 'db.nim')
            ->join('mahasiswas as m', 'ps.nim', '=', 'm.nim')
            ->join('status_akses as sk', 'ps.nim', '=', 'sk.nim')
            ->select('db.nama_mhs', 'db.nim', 'ps.persentase_skripsi', 'ps.keterangan', 'm.angkatan')
            ->where('nip', $nip->nip)->where('sk.no_statusAkses', '<', '7')
            ->where('m.angkatan', '=', $request->angkatan)
            ->get();

        // dd($mahasiswa);

        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        $sum = $mahasiswa->count();
        $tahun = $request->angkatan;

        return view('dosen/filter', compact('mahasiswa', 'angkatan', 'sum', 'tahun'));
    }

    public function mahasiswaBimbingan()
    {
        return view('dosen.mahasiswaTA');
    }

    public function lembar_kendali($nim)
    {
        $this->nim = $nim;
        return view('dosen.lembar_kendali', compact('nim'));
    }

    public function lembar_kendali_sempro($nim)
    {
        $data       = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_sempros as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_sempro')
            ->where('m.nim', '=', $nim)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_sempro)->translatedFormat('l, d F Y');
        $dosbing1   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing1)->select('nama')->first();
        $dosbing2   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing2)->select('nama')->first();
        return view('dosen.berkas.lembar_kendali_sempro', compact('data', 'dosbing1', 'dosbing2', 'tanggal'));
    }

    public function lembar_kendali_semhas($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_semhas')
            ->where('m.nim', '=', $nim)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_semhas)->translatedFormat('l, d F Y');
        $dosbing1   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing1)->select('nama')->first();
        $dosbing2   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing2)->select('nama')->first();

        return view('dosen.berkas.lembar_kendali_semhas', compact('data', 'dosbing1', 'dosbing2', 'tanggal'));
    }

    public function lembar_kendali_sidang($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_sidang')
            ->where('m.nim', '=', $nim)
            ->first();

        $tanggal    = Carbon::parse($data->tanggal_sidang)->translatedFormat('l, d F Y');
        $dosbing1   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing1)->select('nama')->first();
        $dosbing2   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing2)->select('nama')->first();
        return view('dosen.berkas.lembar_kendali_sidang', compact('data', 'dosbing1', 'dosbing2', 'tanggal'));
    }

    public function mahasiswaUji()
    {
        return view('dosen.mahasiswaUji.mahasiswaUji-dosen');
    }

    //INI MON
    public function mejaHijau()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('jdSidangMejaHijau')
            ->where('nip', $nip->nip)
            ->orderBy('tanggal_sidang', 'DESC')
            ->get();
        return view('dosen.sidangMejaHijau', compact('query'));
    }

    public function mejaHijau1()
    {
        return view('dosen.mahasiswaUji.mejaHijau-dosen');
    }

    public function pascaMeHij()
    {
        return view('dosen.mahasiswaBimbingan.pascaMeHij-dosen');
    }

    public function pascaMeHij1()
    {
        return view('dosen.mahasiswaUji.pascaMeHij-dosen');
    }

    public function praMehij()
    {
        return view('dosen.mahasiswaBimbingan.praMehij-dosen');
    }

    public function praMehij1()
    {
        return view('dosen.mahasiswaUji.praMehij-dosen');
    }

    public function progresSkripsi()
    {
        return view('dosen.mahasiswaBimbingan.progresSkripsi-dosen');
    }

    public function semhas()
    {
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('v_jdSemhas')
            ->where('nip', $nip->nip)
            ->orderBy('tanggal_semhas', 'DESC')
            ->get();
        return view('dosen.semhas', compact('query'));
    }

    public function semhas1()
    {
        return view('dosen.mahasiswaUji.semhas-dosen');
    }

    public function sempro()
    {
        // dd($data);
        $nip = Dosen::where('id_user', Auth::user()->id)->select('nip')->first();
        $query = DB::table('v_jdSempro')
            ->where('nip', $nip->nip)
            ->orderBy('tanggal_sempro', 'DESC')
            ->get();

        return view('dosen.sempro', compact('query'));
    }

    public function sempro1()
    {
        return view('dosen.mahasiswaUji.sempro-dosen');
    }

    public function jadwalSeminarSidang()
    {
        return view('dosen.mahasiswaBimbingan.sidMejaHijau-dosen');
    }

    public function sidMejaHijau1()
    {
        return view('dosen.mahasiswaUji.sidMejaHijau-dosen');
    }
}
