<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Skripsi;
use App\Models\NilaiIPK;
use App\Models\Mahasiswa;
use App\Models\NilaiSemhas;
use Illuminate\Http\Request;
use App\Models\NilaiUjiProgram;
use App\Models\NilaiSeminarHasil;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NilaiSidangMejaHijau;
use Illuminate\Support\Facades\Auth;

class KepalaProdiController extends Controller
{
    public function index()
    {
        return view('kepala_prodi.dashboard');
    }

    public function menu_mahasiswa()
    {
        return view('kepala_prodi.menu_mahasiswa');
    }

    public function mahasiswa_aktif()
    {
        $mahasiswas = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->leftJoin('v_progress_skripsi as ps', 'v.nim', '=', 'ps.nim')
            ->select('s.judul_skripsi', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2', 'ps.persentase_skripsi')
            ->where('m.status', '=', 'aktif')
            ->orderBy('nim', 'ASC')
            ->paginate(25);

        $angkatan = DB::table('mahasiswas as m')
            ->select('m.angkatan')
            ->distinct()
            ->get();
        return view('kepala_prodi/mahasiswa_aktif', compact('mahasiswas', 'angkatan'));
    }

    public function cari_mahasiswa(Request $request)
    {
        $results = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->leftJoin('skripsis as s', 'v.nim', '=', 's.nim')
            ->select('s.judul_skripsi', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('v.nama_mhs', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nim', 'like', "%" . $request->keyword . "%")
            ->orWhere('s.judul_skripsi', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nama_dosbing1', 'like', "%" . $request->keyword . "%")
            ->orWhere('v.nama_dosbing2', 'like', "%" . $request->keyword . "%")
            ->paginate(25);
        $counter = $results->count();
        return view('kepala_prodi/hasil_pencarian', compact('results', 'counter'));
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
            ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'vp.persentase_skripsi', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('m.angkatan', '=', $request->angkatan)
            ->orderBy('v.nim', 'ASC')
            ->paginate(25);

        $sum = $mahasiswas->count();
        $tahun = $request->angkatan;
        return view('kepala_prodi.filter', compact('mahasiswas', 'keterangan', 'sum', 'angkatan', 'tahun'));
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
            ->join('v_progress_skripsi as vp', 'm.nim', '=', 'vp.nim')
            ->select('s.judul_skripsi', 'k.keterangan', 'm.angkatan', 'm.foto', 'vp.persentase_skripsi', 'v.nama_mhs', 'v.nim', 'v.nama_dosbing1', 'v.nama_dosbing2')
            ->where('m.status', '=', 'aktif')
            ->where('m.angkatan', '=', $request->tahun)
            ->where('sa.no_statusAkses', '=', $request->no_statusAkses)
            ->orderBy('v.nim', 'ASC')
            ->paginate(25);
        $tahun = $request->tahun;
        $sum = $mahasiswas->count();
        return view('kepala_prodi.filter2', compact('mahasiswas', 'keterangan', 'sum', 'angkatan', 'tahun'));
    }
    public function mahasiswa_alumni()
    {
        $alumnus = DB::table('log_mahasiswa_luluses')
            ->select('nim', 'nama', 'judul_skripsi', 'bidang_ilmu', 'nip_dosbing1', 'nama_dosbing1', 'nip_dosbing2', 'nama_dosbing2')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);
        return view('kepala_prodi/alumni', compact('alumnus'));
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
        return view('kepala_prodi/hasil_pencarian_alumni', compact('results', 'counter'));
    }

    public function berita_acara()
    {
        return view('kepala_prodi.beritaacara');
    }

    public function berita_acaraSempro()
    {
        $query = DB::table('v_jdSempro as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->join('mahasiswas as m', 'js.nim', '=', 'm.nim')
            ->join('keterangan_status_akses as kt', 'st.no_statusAkses', '=', 'kt.no_statusAkses')
            ->select('js.nama', 'js.nim', 'kt.keterangan')
            ->where('m.status', '=', 'aktif')
            ->paginate(5);
        return view('kepala_prodi.beritaacaraSempro', compact('query'));
    }

    public function berita_acara_sempro($nim)
    {
        $mahasiswa = DB::table('v_jdSempro')->where('nim', $nim)->select('nama', 'nim', 'bidang_TA', 'judul_skripsi', 'nama_dosen', 'nip', 'tanggal_sempro', 'waktu')->get();
        $nilai_kelayakan = DB::table('daftar_nilai_uji_kelayakan')
            ->where('nim', $nim)->get();
        // dd($nilai_kelayakan);
        return view('kepala_prodi.beritaacara-sempro', compact('mahasiswa', 'nilai_kelayakan'));
    }

    public function berita_acaraSemhas()
    {
        $query = DB::table('daftar_nilai_semhas as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->join('mahasiswas as m', 'js.nim', '=', 'm.nim')
            ->join('keterangan_status_akses as kt', 'st.no_statusAkses', '=', 'kt.no_statusAkses')
            ->select('js.nama_mahasiswa as nama', 'js.nim', 'kt.keterangan')
            ->where('m.status', '=', 'aktif')
            ->paginate(5);

        return view('kepala_prodi.beritaacaraSemhas', compact('query'));
    }

    public function berita_acara_semhas($nim)
    {
        $this->nim = $nim;
        $mahasiswa = DB::table('v_jdsemhas as m')
            ->leftJoin('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->select('m.nama', 'm.nim', 'm.judul_skripsi', 'm.bidang_TA', 'm.nama_dosen', 'm.nip', 'm.tanggal_semhas', 'm.waktu', 'dp.nama_dosen_penguji1', 'dp.nip_dosen_penguji1', 'dp.nama_dosen_penguji2', 'dp.nip_dosen_penguji2')
            ->where('m.nim', $nim)
            ->get();
        $nilai_semhas = DB::table('daftar_nilai_semhas')
            ->where('nim', $nim)->get();
        return view('kepala_prodi.beritaacara-semhas', compact('mahasiswa', 'nilai_semhas'));
    }

    public function berita_acaraMejahijau()
    {
        $query = DB::table('daftar_nilai_sidang as js')
            ->join('status_akses as st', 'js.nim', '=', 'st.nim')
            ->join('mahasiswas as m', 'js.nim', '=', 'm.nim')
            ->join('keterangan_status_akses as kt', 'st.no_statusAkses', '=', 'kt.no_statusAkses')
            ->select('js.nama_mahasiswa as nama', 'js.nim', 'kt.keterangan')
            ->where('m.status', '=', 'aktif')
            ->paginate(5);

        return view('kepala_prodi.beritaacaraMejahijau', compact('query'));
    }

    public function berita_acara_mejahijau($nim)
    {
        $mahasiswa = DB::table('daftar_nilai_sidang as ds')
            ->join('skripsis as s', 'ds.nim', '=', 's.nim')
            ->where('s.nim', $nim)->select('ds.nama_mahasiswa as nama', 's.nim', 's.judul_skripsi', 'ds.nama_dosen', 'ds.nip')->get();
        $nilai_sidang = DB::table('daftar_nilai_sidang')
            ->where('nim', $nim)->get();
        return view('kepala_prodi.beritaacara-mejahijau', compact('mahasiswa', 'nilai_sidang'));
    }

    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }

    public function undangan_daftar_peserta()
    {
        return view('kepala_prodi.undangan_daftar_peserta');
    }

    public function daftar_sempro()
    {
        $query = DB::table('v_dosbing as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.nama_mhs', 'v.nim', 'v.nip_dosbing1', 'v.nama_dosbing1', 'v.nip_dosbing2', 'v.nama_dosbing2')

            ->where('m.status', '=', 'aktif')
            ->get();

        $nim = DB::table('v_jdsempro as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_sempro', 'v.nim', 'v.judul_skripsi')
            ->where('m.status', '=', 'aktif')
            // filter tanggal yang lebih dari hari ini
            ->where('v.tanggal_sempro', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('tanggal_sempro', 'ASC')
            ->get();

        $tanggal = DB::table('v_jdsempro as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_sempro')
            ->where('v.tanggal_sempro', '>=', Carbon::now()->format('Y-m-d'))
            ->where('m.status', '=', 'aktif')
            ->distinct()->orderBy('tanggal_sempro', 'ASC')
            ->get();

        return view('kepala_prodi.daftar_sempro', compact('query', 'nim', 'tanggal'));
    }

    public function undangan_sempro($tanggal)
    {
        $query = DB::table('v_jdSempro as js')
            ->leftjoin('mahasiswas as m', 'm.nim', '=', 'js.nim')
            ->where('js.tanggal_sempro', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($query[0]->tanggal_sempro)->translatedFormat('l / d F Y');
        $now = Carbon::now();
        $date_now = Carbon::parse($now)->translatedFormat('d F Y');

        return view('kepala_prodi.berkas.undangan_sempro', compact('date', 'date_now', 'query'));
    }

    public function peserta_sempro($tanggal)
    {
        $query = DB::table('v_jdSempro as js')
            ->leftjoin('mahasiswas as m', 'm.nim', '=', 'js.nim')
            ->where('js.tanggal_sempro', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($tanggal)->translatedFormat('l / d F Y');
        return view('kepala_prodi.berkas.daftar_peserta_sempro', compact('query', 'date'));
    }

    public function daftar_semhas()
    {
        // $query = DB::table('v_dosbing as db')
        //             -> join('v_dosen_penguji as dp', 'db.nim', '=','dp.nim')
        //             -> select('db.nama_mhs', 'db.nim', 'db.nama_dosbing1', 'db.nip_dosbing1', 'db.nama_dosbing2', 'db.nip_dosbing2',
        //              'dp.nama_dosen_penguji1', 'dp.nip_dosen_penguji1', 'dp.nama_dosen_penguji2', 'dp.nip_dosen_penguji2',)
        //             ->get();

        $query = DB::table('v_dosbing as db as db')
            ->join('v_dosen_penguji as dp', 'db.nim', '=', 'dp.nim')
            ->join('mahasiswas as m', 'db.nim', '=', 'm.nim')
            ->select(
                'db.nama_mhs',
                'db.nim',
                'db.nama_dosbing1',
                'db.nip_dosbing1',
                'db.nama_dosbing2',
                'db.nip_dosbing2',
                'dp.nama_dosen_penguji1',
                'dp.nip_dosen_penguji1',
                'dp.nip_dosen_penguji2',
                'dp.nama_dosen_penguji2',
                'dp.nip_dosen_penguji2'
            )
            ->where('m.status', '=', 'aktif')
            ->get();

        $nim = DB::table('v_jdsemhas as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_semhas', 'v.nim', 'v.judul_skripsi')
            ->where('v.tanggal_semhas', '>=', Carbon::now()->format('Y-m-d'))
            ->where('m.status', '=', 'aktif')
            ->orderBy('tanggal_semhas', 'ASC')->get();

        $tanggal = DB::table('v_jdsemhas as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_semhas')
            ->where('v.tanggal_semhas', '>=', Carbon::now()->format('Y-m-d'))
            ->where('m.status', '=', 'aktif')
            ->distinct()->orderBy('tanggal_semhas', 'ASC')->get();

        return view('kepala_prodi.daftar_semhas', compact('query', 'nim', 'tanggal'));
    }

    public function undangan_semhas($tanggal)
    {
        $query = DB::table('v_jdSemhas as js')
            ->leftjoin('mahasiswas as m', 'm.nim', '=', 'js.nim')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_semhas', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_semhas', '=', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($query[0]->tanggal_semhas)->translatedFormat('l / d F Y');
        $now = Carbon::now();
        $date_now = Carbon::parse($now)->translatedFormat('d F Y');

        return view('kepala_prodi.berkas.undangan_semhas', compact('date', 'date_now', 'query'));
    }

    public function peserta_semhas($tanggal)
    {
        // $query = DB::table('v_jdSemhas')->where('tanggal_semhas', $tanggal)->get();
        // $query2 = DB::select('SELECT mahasiswas.nim, mahasiswas.nama, dosens.nip, dosens.nama AS nama_dosen FROM dosen_pengujis 
        // JOIN mahasiswas ON dosen_pengujis.nim = mahasiswas.nim 
        // JOIN dosens ON dosen_pengujis.penguji1 = dosens.nip OR dosen_pengujis.penguji2 = dosens.nip');

        $query = DB::table('v_jdSemhas as js')
            ->leftjoin('mahasiswas as m', 'm.nim', '=', 'js.nim')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_semhas', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_semhas', '=', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($tanggal)->translatedFormat('l / d F Y');
        return view('kepala_prodi.berkas.daftar_peserta_semhas', compact('query', 'date'));
    }

    public function daftar_sidang()
    {
        $query = DB::table('v_dosbing as db as db')
            ->join('v_dosen_penguji as dp', 'db.nim', '=', 'dp.nim')
            ->join('mahasiswas as m', 'db.nim', '=', 'm.nim')
            ->select(
                'db.nama_mhs',
                'db.nim',
                'db.nama_dosbing1',
                'db.nip_dosbing1',
                'db.nama_dosbing2',
                'db.nip_dosbing2',
                'dp.nama_dosen_penguji1',
                'dp.nip_dosen_penguji1',
                'dp.nip_dosen_penguji2',
                'dp.nama_dosen_penguji2',
                'dp.nip_dosen_penguji2'
            )
            ->where('m.status', '=', 'aktif')
            ->get();

        $nim = DB::table('jdsidangmejahijau as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_sidang', 'v.nim', 'v.judul_skripsi')
            ->where('m.status', '=', 'aktif')
            ->orderBy('tanggal_sidang', 'ASC')->get();

        $tanggal = DB::table('jdsidangmejahijau as v')
            ->join('mahasiswas as m', 'v.nim', '=', 'm.nim')
            ->select('v.tanggal_sidang')
            ->where('m.status', '=', 'aktif')
            ->distinct()->orderBy('tanggal_sidang', 'ASC')->get();

        return view('kepala_prodi.daftar_sidang', compact('query', 'nim', 'tanggal'));
    }

    public function undangan_sidang($tanggal)
    {
        $query = DB::table('jdsidangmejahijau as js')
            ->join('mahasiswas as m', 'js.nim', '=', 'm.nim')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_sidang', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_sidang', '=', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('l / d F Y');
        $now = Carbon::now();
        $date_now = Carbon::parse($now)->translatedFormat('d F Y');

        return view('kepala_prodi.berkas.undangan_sidang', compact('date', 'date_now', 'query'));
    }

    public function peserta_sidang($tanggal)
    {
        // $query = DB::table('jdsidangmejahijau')->where('tanggal_sidang', $tanggal)->get();
        // $query2 = DB::select('SELECT mahasiswas.nim, mahasiswas.nama, dosens.nip, dosens.nama AS nama_dosen FROM dosen_pengujis 
        // JOIN mahasiswas ON dosen_pengujis.nim = mahasiswas.nim 
        // JOIN dosens ON dosen_pengujis.penguji1 = dosens.nip OR dosen_pengujis.penguji2 = dosens.nip');

        $query = DB::table('jdsidangmejahijau as js')
            ->join('mahasiswas as m', 'js.nim', '=', 'm.nim')
            ->leftJoin('v_dosen_penguji as db', 'js.nim', '=', 'db.nim')
            ->select('js.nama', 'js.nim', 'js.judul_skripsi', 'js.nama_dosen', 'js.waktu', 'js.tempat', 'js.tanggal_sidang', 'db.nama_dosen_penguji1', 'db.nama_dosen_penguji2')
            ->where('js.tanggal_sidang', '=', $tanggal)
            ->where('m.status', '=', 'aktif')
            ->get();

        $date = Carbon::parse($tanggal)->translatedFormat('l / d F Y');
        return view('kepala_prodi.berkas.daftar_peserta_sidang', compact('query', 'date'));
    }

    public function lembar_kendali($nim)
    {
        $this->nim = $nim;
        return view('kepala_prodi.lembar_kendali', compact('nim'));
    }

    public function lembar_kendali_sempro($nim)
    {
        $data       = DB::table('mahasiswas as m')
            ->join('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sempros as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_sempro')
            ->where('m.nim', '=', $nim)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_sempro)->translatedFormat('l, d F Y');
        $dosbing1   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing1)->select('nama')->first();
        $dosbing2   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing2)->select('nama')->first();
        $bimbingan = DB::table('bimbingan_sempro as bs')
            ->where('bs.nim', '=', $nim)
            ->get();
        return view('kepala_prodi.berkas.lembar_kendali_sempro', compact('data', 'dosbing1', 'dosbing2', 'tanggal', 'bimbingan'));
    }

    public function lembar_kendali_semhas($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->leftJoin('dosen_pembimbings as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nip_dosbing2', 's.judul_skripsi', 'j.tanggal_semhas')
            ->where('m.nim', '=', $nim)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_semhas)->translatedFormat('l, d F Y');
        $dosbing1   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing1)->select('nama')->first();
        $dosbing2   = DB::table('dosens')->where('nip', '=', $data->nip_dosbing2)->select('nama')->first();
        $bimbingan = DB::table('bimbingan_semhas as bs')
            ->where('bs.nim', '=', $nim)
            ->get();

        return view('kepala_prodi.berkas.lembar_kendali_semhas', compact('data', 'dosbing1', 'dosbing2', 'tanggal', 'bimbingan'));
    }

    public function lembar_kendali_sidang($nim)
    {
        $data   = DB::table('mahasiswas as m')
            ->leftJoin('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nama_dosbing1', 'dp.nip_dosbing2', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_sidang')
            ->where('m.nim', '=', $nim)
            ->first();

        $bimbingan = DB::table('bimbingan_sidang as bs')
            ->where('bs.nim', '=', $nim)
            ->get();

        $tanggal    = Carbon::parse($data->tanggal_sidang)->translatedFormat('l, d F Y');
        return view('kepala_prodi.berkas.lembar_kendali_sidang', compact('data', 'tanggal', 'bimbingan'));
    }

    // FUNGSI UNTUK INPUT NILAI
    public function input_nilai()
    {
        return view('kepala_prodi.input_nilai');
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
        // dd($mahasiswas);
        return view('kepala_prodi.daftar_nilai_uji_program', compact('mahasiswas'));
    }

    public function add_nilai_uji_program(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosbing as v', 'm.nim', '=', 'v.nim')
            ->select('m.nim', 'm.nama', 'v.nip_dosbing1', 'v.nama_dosbing1', 'v.nip_dosbing2', 'v.nama_dosbing2')
            ->where('m.nim', $request->nim)
            ->first();
        return view('kepala_prodi/add_nilai_program', compact('data'));
    }

    public function store_nilai_program(Request $request)
    {
        // return 'berhasil';
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9|unique:nilai_uji_programs',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'n5'        => 'nullable|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        if (NilaiUjiProgram::where('nim', $request->nim)->count() != 0) {
            return redirect('/kepala_prodi/daftar_nilai_uji_program')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
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
            return redirect('/kepala_prodi/daftar_nilai_uji_program')->with('success_add_nilai_uji_program', 'Nilai berhasil disimpan!');
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
        return view('kepala_prodi/edit_nilai_program', compact('data'));
    }

    public function store_upd_nilai_uji_program(Request $request)
    {
        $validated = $request->validate([
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'n5'        => 'nullable|numeric',
            // 'n6'        => 'required|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required',
        ]);

        NilaiUjiProgram::where('nim', $request->nim)->update([
            'nip'                             => $request->nip,
            'nilai_kemampuan_dasar_program'   => $request->n1 ? floatval($request->n1) : null,
            'nilai_kecocokan_algoritma'       => $request->n2 ? floatval($request->n2) : null,
            'nilai_penguasaan_program'        => $request->n3 ? floatval($request->n3) : null,
            'nilai_penguasaan_ui'             => $request->n4 ? floatval($request->n4) : null,
            'nilai_validasi_output'           => $request->n5 ? floatval($request->n5) : null,
            'tanggal'                         => $request->tanggal,
            'waktu'                           => $request->waktu,
        ]);

        return redirect('/kepala_prodi/daftar_nilai_uji_program')->with('success_update_nilai_uji_program', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_uji_program(Request $request)
    {
        NilaiUjiProgram::where('nim', $request->nim)->delete();
        return redirect('/kepala_prodi/daftar_nilai_uji_program')->with('success_delete_nilai_uji_program', 'Nilai berhasil dihapus!');
    }

    //2. input nilai sidang meja hijau
    public function daftar_nilai_sidang_meja_hijau()
    {
        $mahasiswas = DB::table('mahasiswas as m')
            ->leftJoin('daftar_nilai_sidang as n', 'm.nim', '=', 'n.nim')
            ->leftJoin('dosens as d', 'n.nip', '=', 'd.nip')
            ->join('status_akses as s', 'm.nim', 's.nim')
            ->select('m.nama', 'm.nim', 'd.nip', 'd.nama as nama_dsn', 'n.total')
            ->orderBy('nim')
            ->where('m.status', 'aktif')
            ->where('s.no_statusAkses', '>=', 5)
            ->orderBy('m.nim')
            ->get();
        //   dd($mahasiswas);

        return view('kepala_prodi.daftar_nilai_sidang', compact('mahasiswas'));
    }

    public function add_nilai_sidang(Request $request)
    {
        // nim, nama mahasiswa, nip_dosbing1, nama_dosbing1, nip_dosbing2, nama_dosbing2, nip_dosen_penguji1, nama_dosen_penguji1, nip_dosen_penguji2, nama_dosen_penguji2 jika status >= 5
        // $data = DB::table('mahasiswas as m')
        //     ->join('nilai_sidang_meja_hijaus as n', 'm.nim', '=', 'n.nim')
        //     ->join('dosens as d', 'n.nip', '=', 'd.nip')
        //     ->select('m.nim', 'm.nama', 'd.nip', 'd.nama', 'n.total')
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('m.nim', $request->nim)
            ->first();
        return view('kepala_prodi/add_nilai_sidang', compact('data'));
    }

    public function store_nilai_sidang(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        if (NilaiSidangMejaHijau::where('nim', $request->nim)->where('nip', $request->nip)->count() != 0) {
            return redirect('/kepala_prodi/daftar_nilai_sidang')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
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
            return redirect('/kepala_prodi/daftar_nilai_sidang')->with('status', 'Nilai berhasil disimpan!');
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
        return view('kepala_prodi/edit_nilai_sidang', compact('data'));
    }

    public function store_upd_nilai_sidang(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        NilaiSidangMejaHijau::where('nim', $request->nim)->where('nip', $request->nip)->update([
            'sistematika_penulisan'             => $request->n1 ? floatval($request->n1) : null,
            'substansi'                         => $request->n2 ? floatval($request->n2) : null,
            'kemampuan_menguasai_substansi'     => $request->n3 ? floatval($request->n3) : null,
            'kemampuan_mengemukakan_pendapat'   => $request->n4 ? floatval($request->n4) : null,
            'total'                             => $request->n1 && $request->n2 && $request->n3 && $request->n4 ? floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4) : null,
            'tanggal'                           => $request->tanggal,
            'waktu'                             => $request->waktu,
        ]);


        return redirect('/kepala_prodi/daftar_nilai_sidang')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_sidang(Request $request)
    {
        NilaiSidangMejaHijau::where('nim', $request->nim)->where('nip', $request->nip)->delete();
        return redirect('/kepala_prodi/daftar_nilai_sidang')->with('status', 'Nilai berhasil dihapus!');
    }

    //3. input nilai seminar hasil
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
        return view('kepala_prodi.daftar_nilai_semhas', compact('mahasiswas'));
    }

    public function add_nilai_semhas(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftJoin('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->leftjoin('v_dosbing as f', 'm.nim', '=', 'f.nim')
            ->select('m.nim', 'm.nama', 'f.nip_dosbing1', 'f.nama_dosbing1', 'f.nip_dosbing2', 'f.nama_dosbing2', 'v.nip_dosen_penguji1', 'v.nama_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji2')
            ->where('m.nim', $request->nim)
            ->first();
        return view('kepala_prodi/add_nilai_semhas', compact('data'));
    }

    public function store_nilai_semhas(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'n5'        => 'nullable|numeric',
            'n6'        => 'nullable|numeric',
            'n7'        => 'nullable|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);


        if (NilaiSemhas::where('nim', $request->nim)->count() > 0) {
            return redirect('/kepala_prodi/daftar_nilai_semhas')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
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
            $n1->tanggal                         = $request->tanggal;
            $n1->waktu                           = $request->waktu;
            $n1->save();

            return redirect('/kepala_prodi/daftar_nilai_semhas')->with('success_add_nilai_semhas', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_semhas(Request $request)
    {
        // dd($request->all());
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
        return view('kepala_prodi/edit_nilai_semhas', compact('data'));
    }

    public function store_upd_nilai_semhas(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9',
            'nip'       => 'required|numeric|digits_between:18,18',
            'n1'        => 'nullable|numeric',
            'n2'        => 'nullable|numeric',
            'n3'        => 'nullable|numeric',
            'n4'        => 'nullable|numeric',
            'n5'        => 'nullable|numeric',
            'n6'        => 'nullable|numeric',
            'n7'        => 'nullable|numeric',
            'total'     => 'nullable|numeric',
            'tanggal'   => 'required',
            'waktu'     => 'required'
        ]);

        // update nilai dari tabel nilai_seminar_hasils where nim = $request->nim and nip = $request->nip
        NilaiSemhas::where('nim', $request->nim)->where('nip', $request->nip)
            ->update([
                'abstrak'                         => floatval($request->n1),
                'pendahuluan'                     => floatval($request->n2),
                'landasan_teori'                  => floatval($request->n3),
                'metodologi'                      => floatval($request->n4),
                'implementasi'                    => floatval($request->n5),
                'kesimpulan'                      => floatval($request->n6),
                'kemampuan_mengemukakan_substansi' => floatval($request->n7),
                'total'                           => floatval($request->n1) + floatval($request->n2) + floatval($request->n3) + floatval($request->n4) + floatval($request->n5) + floatval($request->n6) + floatval($request->n7),
                'tanggal'                         => $request->tanggal,
                'waktu'                           => $request->waktu
            ]);

        return redirect('/kepala_prodi/daftar_nilai_semhas')->with('success_upd_nilai_semhas', 'Nilai berhasil diubah!');
    }


    public function delete_nilai_semhas(Request $request)
    {
        NilaiSeminarHasil::where('nim', $request->nim)->where('nip', $request->nip)->delete();
        return redirect('/kepala_prodi/daftar_nilai_semhas')->with('success_delete_nilai_semhas', 'Nilai berhasil dihapus!');
    }

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
        return view('kepala_prodi.daftar_nilai_IPK', compact('mahasiswas'));
    }

    public function add_nilai_IPK(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->select('m.nim', 'm.nama')
            ->where('m.nim', $request->nim)
            ->first();
        return view('kepala_prodi/add_nilai_IPK', compact('data'));
    }

    public function store_nilai_IPK(Request $request)
    {
        $validated = $request->validate([
            'nim'       => 'required|numeric|digits_between:9,9|unique:nilai_seminar_hasils',
            'IPK'        => 'required|numeric'
        ]);

        if (NilaiIPK::where('nim', $request->nim)->count() > 0) {
            return redirect('/kepala_prodi/daftar_nilai_IPK')->with('prohibited', 'Nilai untuk mahasiswa ini sudah didata!');
        } else {
            $n                = new NilaiIPK;
            $n->nim           = $request->nim;
            $n->IPK           = floatval($request->IPK);
            $n->save();

            return redirect('/kepala_prodi/daftar_nilai_IPK')->with('status', 'Nilai berhasil disimpan!');
        }
    }

    public function edit_nilai_IPK(Request $request)
    {
        $data = DB::table('mahasiswas as m')
            ->leftjoin('nilai_i_p_k_s as n', 'n.nim', '=', 'm.nim')
            ->select('m.nim', 'm.nama', 'n.IPK')
            ->where('m.nim', $request->nim)
            ->first();
        return view('kepala_prodi/edit_nilai_IPK', compact('data'));
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
        return redirect('/kepala_prodi/daftar_nilai_IPK')->with('status', 'Nilai berhasil diperbaharui!');
    }

    public function delete_nilai_IPK(Request $request)
    {
        NilaiIPK::where('nim', $request->nim)->delete();
        return redirect('/kepala_prodi/daftar_nilai_IPK')->with('status', 'Nilai berhasil dihapus!');
    }



    //END OF FUNGSI UNTUK INPUT NILAI
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
}
