<?php

namespace App\Http\Controllers;

use PDF;
use File;
use App\Models\Exum;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Skripsi;
use App\Models\Mahasiswa;
use App\Models\BidangIlmu;
use App\Models\StatusAkses;
use Illuminate\Http\Request;
use App\Models\PengajuanJudul;
use Illuminate\Support\Carbon;
use Illuminate\Translation\Translator;
use App\Models\AjukanBidangIlmu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogPengubahanSkripsi;
use Illuminate\Support\Facades\Auth;
use App\Models\LogPendaftaranSkripsi;
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{
    //fungsi ke menu sidebar dashboard
    public function index()
    {
        $profile   = DB::table('mahasiswas as m')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->select('m.nim', 'm.nama', 'm.angkatan', 'm.foto', 'm.status', 's.judul_skripsi')
            ->where('id_user', Auth::user()->id)
            ->first();

        $status_akses = DB::table('status_akses as sa')
            ->join('keterangan_status_akses as k', 'sa.no_statusAkses', '=', 'k.no_statusAkses')
            ->select('sa.no_statusAkses', 'k.keterangan')
            ->where('nim', '=', $profile->nim)
            ->first();

        $percent = round((($status_akses->no_statusAkses / 7) * 100), 2);
        return view('mahasiswa/dashboard', compact('profile', 'status_akses', 'percent'));
    }

    // fungsi ke menu pra seminar proposal
    public function pra_sempro()
    {
        $bidang_ilmu = BidangIlmu::all();
        $mhs = DB::table('mahasiswas as m')
            ->join('status_akses as s', 's.nim', '=', 'm.nim')
            ->select('s.no_statusAkses', 'm.nim')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $skripsi_checker = Skripsi::where('nim', $mhs->nim)->count();
        $pengajuan_judul_checker = PengajuanJudul::where('nim', $mhs->nim)->count();
        $exum_checker = Exum::where('nim', $mhs->nim)->count();
        $exum = "-";
        $pengajuan_bidang_ilmu = AjukanBidangIlmu::where('id_user', Auth::user()->id)->count();
        if ($exum)
            $exum = Exum::where('nim', $mhs->nim)->first();

        return view('mahasiswa.pra_sempro', compact('mhs', 'skripsi_checker', 'bidang_ilmu', 'exum', 'exum_checker', 'pengajuan_judul_checker', 'pengajuan_bidang_ilmu'));
    }

    // fungsi ke menu pra seminar hasil
    public function pra_semhas()
    {
        $mhs = DB::table('mahasiswas')
            ->join('status_akses', 'status_akses.nim', '=', 'mahasiswas.nim')
            ->select('status_akses.no_statusAkses', 'mahasiswas.nim')
            ->where('mahasiswas.id_user', '=', Auth::user()->id)
            ->first();

        $bimbingan_check = DB::table('bimbingan_semhas')->where('nim', $mhs->nim)->count();
        return view('mahasiswa.pra_semhas', compact('mhs', 'bimbingan_check'));
    }

    // fungsi ke menu pra sidang meja hijau
    public function pra_sidang()
    {
        $mhs = DB::table('mahasiswas')
            ->join('status_akses', 'status_akses.nim', '=', 'mahasiswas.nim')
            ->select('status_akses.no_statusAkses', 'mahasiswas.nim')
            ->where('mahasiswas.id_user', '=', Auth::user()->id)
            ->first();
        $bimbingan_check = DB::table('bimbingan_sidang')->where('nim', $mhs->nim)->count();
        return view('mahasiswa.pra_sidang', compact('mhs', 'bimbingan_check'));
    }

    public function pendaftaran_judul()
    {
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)
            ->select('nim')
            ->first();
        $bidang_ilmu = BidangIlmu::all();
        return view('/mahasiswa/pendaftaran_judul', compact('mahasiswa', 'bidang_ilmu'));
    }

    public function daftar_judul(Request $request)
    {
        $mahasiswa = Mahasiswa::where('id_user', Auth::user()->id)
            ->select('nim', 'nama')
            ->first();
        $bidang_ilmu = DB::table('bidang_ilmus as b')
            ->join('ajukan_bidang_ilmus as ab', 'b.id', '=', 'ab.bidang_ilmu1')
            ->select('b.bidang_ilmu')
            ->where('id_user', Auth::user()->id)
            ->first();
        $judul = PengajuanJudul::where('nim', $mahasiswa->nim)->get();
        // -- nama
        // -- nim
        // -- pengaju enum(dosen, mahasiswa)
        // -- Judul / Topik Skripsi 	
        // -- Latar Belakang dan Penelitian Terdahulu 	
        // -- Rumusan Masalah 	
        // -- Metodologi 	
        // -- Referensi 
        $daftar_judul = new PengajuanJudul;
        $daftar_judul->nim = $mahasiswa->nim;
        $daftar_judul->nama = $mahasiswa->nama;
        $daftar_judul->pengaju = $request->pengaju;
        $daftar_judul->judul_skripsi = $request->judul;
        $daftar_judul->latar_belakang = $request->latar_belakang;
        $daftar_judul->rumusan_masalah = $request->rumusan_masalah;
        $daftar_judul->metodologi = $request->metodologi;
        $daftar_judul->referensi = $request->referensi;
        $daftar_judul->save();
        // parse $request->judul from indonesia to english using Translator laravel
        // $judul = Translator :: translate($request->judul, 'id', 'en');
        // -- nim


        $skripsi = new Skripsi;
        $skripsi->nim = $mahasiswa->nim;
        $skripsi->judul_skripsi = $request->judul;
        $skripsi->eng_judul_skripsi = $request->judul;
        $skripsi->bidang_ilmu = $bidang_ilmu->bidang_ilmu;
        $skripsi->save();

        return redirect('/mahasiswa/pra_sempro')->with('success', 'Judul berhasil didaftarkan');
    }

    public function store_judul(Request $request)
    {
        $validated = $request->validate([
            'judul_skripsi'         => 'required|min:20|max:255|unique:skripsis',
            'eng_judul_skripsi'     => 'required|min:20|max:255|unique:skripsis',
            'bid_tulis'             => 'required|min:5|max:255',
        ]);
        $log                    = new LogPendaftaranSkripsi;
        $log->id_user           = Auth::user()->id;
        $log->nama_pendaftar    = Auth::user()->mhs->nama;
        $log->nim               = $request->nim;
        $log->judul_skripsi     = $request->judul_skripsi;
        $log->registered_by     = 'mahasiswa';
        $log->save();

        $skripsi                    = new Skripsi;
        $skripsi->nim               = $request->nim;
        $skripsi->judul_skripsi     = $request->judul_skripsi;
        $skripsi->eng_judul_skripsi = $request->eng_judul_skripsi;
        $skripsi->bidang_ilmu       = $request->bid_tulis;
        $skripsi->save();

        return redirect('/mahasiswa/pra_sempro')->with('status', 'Judul berhasil disimpan!');
    }

    public function store_new_judul(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'new_judul_skripsi'  => 'required|min:20|max:255',
            'new_eng_judul_skripsi'  => 'required|min:20|max:255',
            // 'bid_ilmu' => 'required|min:5|max:255',
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
                $log->nim               = Auth::user()->mhs->nim;
                $log->nama_pengubah     = Auth::user()->mhs->nama;
                $log->old_judul_skripsi = $request->old_judul;
                $log->new_judul_skripsi = $request->new_judul_skripsi;
                $log->old_bidang_ilmu   = $request->old_bidang_ilmu;
                $log->new_bidang_ilmu   = $request->old_bidang_ilmu;
                $log->edited_by         = 'mahasiswa';
                $log->save();

                // CALL p_update_judul_skripsi('171402003', 'Analisa Perancangan Sistem Pendukung Keputusan Admisi Siswa Baru Menggunakan Analytical Hierarcy Pro', 'Analysis and Design of Decision Support System for Admission of New Students Using Analytical Hierarcy Pro', 'Sistem Informasi', @status);
                // call procedure update judul skripsi
                DB::select('call p_update_judul_skripsi(?, ?, ?, ?, @status)', [
                    Auth::user()->mhs->nim,
                    $request->new_judul_skripsi,
                    $request->new_eng_judul_skripsi,
                    $request->old_bidang_ilmu
                ]);
                // get status
                $status = DB::select('select @status as status');
                // dd($status);
                // Skripsi::where('nim', $request->nim)->update([
                //     'judul_skripsi'         => $request->new_judul_skripsi,
                //     'eng_judul_skripsi'     => $request->new_eng_judul_skripsi,
                //     'bidang_ilmu'           => $request->old_bidang_ilmu
                // ]);

                return redirect('/mahasiswa/pra_sempro')->with('success_edit_judul', 'Judul skripsi berhasil diubah!');
            }
        } else {
            DB::select('call p_update_judul_skripsi(?, ?, ?, ?, @status)', [
                Auth::user()->mhs->nim,
                $request->new_judul_skripsi,
                $request->new_eng_judul_skripsi,
                $request->old_bidang_ilmu
            ]);
            // get status
            $status = DB::select('select @status as status');
            // Skripsi::where('nim', $request->nim)->update([
            //     'judul_skripsi'         => $request->new_judul_skripsi,
            //     'eng_judul_skripsi'     => $request->new_eng_judul_skripsi,
            //     'bidang_ilmu'           => $request->bid_ilmu,
            // ]);
            return redirect('/mahasiswa/pra_sempro')->with('success_edit_judul', 'Judul skripsi berhasil diubah!');
        }
    }

    public function edit_judul(Request $request)
    {
        $mahasiswa = Skripsi::where('nim', $request->nim)->select('nim', 'judul_skripsi', 'eng_judul_skripsi', 'bidang_ilmu')->first();
        $bidang_ilmu = BidangIlmu::all();
        $nama = Auth::user()->mhs->nama;
        return view('mahasiswa.edit_judul', compact('mahasiswa', 'bidang_ilmu', 'nama'));
    }

    // fungsi mengarahkan ke file pdf penggandaan skripsi
    public function penggandaan_skripsi()
    {
        $data = DB::table('mahasiswas as m')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('v_dosen_penguji as v', 'm.nim', '=', 'v.nim')
            ->select('m.nim', 'm.nama', 's.judul_skripsi', 'v.nip_dosen_penguji1', 'v.nip_dosen_penguji2', 'v.nama_dosen_penguji1', 'v.nama_dosen_penguji2')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        return view('mahasiswa/penggandaan_skripsi', compact('data'));
    }

    // fungsi ke menu pasca meja hijau
    public function pasca_meja_hijau()
    {
        $mhs = DB::table('mahasiswas')
            ->join('status_akses', 'status_akses.nim', '=', 'mahasiswas.nim')
            ->select('status_akses.no_statusAkses')
            ->where('mahasiswas.id_user', '=', Auth::user()->id)
            ->first();
        return view('mahasiswa.pasca_sidang', compact('mhs'));
    }

    // fungsi mengarahkan ke file pdf contoh jurnal
    public function jurnal()
    {
        return view('mahasiswa.jurnal');
    }

    // fungsi mengarahkan ke file pdf lembar kendali pra seminar proposal
    public function lembar_kendali_proposal()
    {
        $data       = DB::table('mahasiswas as m')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->join('jadwal_sempros as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_sempro')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $bimbingan_sempro = DB::table('bimbingan_sempro')
            ->where('nim', '=', $data->nim)
            ->get();
        // dd($bimbingan_sempro);
        $tanggal    = Carbon::parse($data->tanggal_sempro)->translatedFormat('l, d F Y');

        return view('mahasiswa.lembar-kendali-proposal', compact('data', 'tanggal', 'bimbingan_sempro'));

        // UNTUK VERSI DOMPDF
        // $data1 = [
        //     'nim'           => $data->nim,   
        //     'nama'          => $data->nama,
        //     'nama_dosbing1' => $data->nama_dosbing1,
        //     'nama_dosbing2' => $data->nama_dosbing2,
        //     'judul_skripsi' => $data->judul_skripsi,
        //     'tanggal'       => $tanggal,
        // ];

        // versi customized paper (A4)
        // $customPaper = array(0,0,595.275590551,841.88976378);    
        // $pdf = PDF::loadView('mahasiswa.lembar-kendali-proposal', $data1)->setPaper($customerPaper, 'portrait');
        // versi lsg atur ukuran kertas jadi A4
        // $pdf = PDF::loadView('mahasiswa.lembar-kendali-proposal', $data1)->setPaper('A4', 'portrait');
        // $pdf = PDF::loadView('mahasiswa.lembar-kendali-proposal');
        // return $pdf->stream('lembar-kendali-sempro.pdf');
        // END UNTUK VERSI DOMPDF
    }

    // fungsi mengarahkah ke file pdf lembar kendali pra seminar hasil
    public function lembar_kendali_semhas()
    {
        $data   = DB::table('mahasiswas as m')
            ->join('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_semhas')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $bimbingan_semhas = DB::table('bimbingan_semhas')
            ->where('nim', '=', $data->nim)
            ->get();
        $tanggal    = Carbon::parse($data->tanggal_semhas)->translatedFormat('l, d F Y');
        return view('mahasiswa.lembar-kendali-semhas', compact('data', 'tanggal', 'bimbingan_semhas'));
    }

    // fungsi mengarahkan ke file pdf lembar kendali pra sidang meja hijau
    public function lembar_kendali_sidang()
    {
        $data   = DB::table('mahasiswas as m')
            ->join('v_dosbing as dp', 'm.nim', '=', 'dp.nim')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select('m.nim', 'm.nama', 'dp.nip_dosbing1', 'dp.nama_dosbing1', 'dp.nama_dosbing2', 's.judul_skripsi', 'j.tanggal_sidang')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $bimbingan_sidang = DB::table('bimbingan_sidang')
            ->where('nim', '=', $data->nim)
            ->get();
        $tanggal    = Carbon::parse($data->tanggal_sidang)->translatedFormat('l, d F Y');
        return view('mahasiswa.lembar-kendali-sidang', compact('data', 'tanggal', 'bimbingan_sidang'));
    }

    // fungsi mengarahkan ke file pdf pengajuan judul skripsi
    public function pengajuan_judul_skripsi()
    {
        $data_mhs = DB::table('mahasiswas')->where('id_user', Auth::user()->id)
            ->select('nama', 'nim', 'foto')->first();
        $pengajuan_judul = DB::table('pengajuan_judul')->where('nim', $data_mhs->nim)->first();
        // dd($pengajuan_judul);
        // $bidang_ilmu1 = DB::table('ajukan_bidang_ilmu')->join('')
        return view('mahasiswa/pengajuan-judul-skripsi', compact('data_mhs', 'pengajuan_judul'));
    }

    // halaman tanggal sempro ATAU berita acara sempro
    public function jadwal_sempro()
    {
        $data = DB::table('mahasiswas as m')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('v_dosbing as v', 'm.nim', '=', 'v.nim')
            ->join('jadwal_sempros as j', 'm.nim', 'j.nim')
            ->select('m.nim', 'm.nama', 's.judul_skripsi', 'v.nama_dosbing1', 'v.nama_dosbing2', 'j.tanggal_sempro', 'v.nip_dosbing1', 'v.nip_dosbing2')
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_sempro)->translatedFormat('l, d F Y');
        return view('mahasiswa/jadwal-sempro', compact('data', 'tanggal'));
    }

    // halaman tanggal semhas ATAU berita acara seminar hasil
    public function jadwal_semhas()
    {
        $data   = DB::table('mahasiswas as m')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->leftJoin('v_dosbing as d', 'm.nim', '=', 'd.nim')
            ->leftJoin('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->join('jadwal_semhas as j', 'm.nim', '=', 'j.nim')
            ->select(
                'm.nim',
                'm.nama',
                's.judul_skripsi',
                'd.nama_dosbing1',
                'd.nama_dosbing2',
                'd.nip_dosbing1',
                'd.nip_dosbing2',
                'j.tanggal_semhas',
                'dp.nama_dosen_penguji1',
                'dp.nama_dosen_penguji2',
                'dp.nip_dosen_penguji1',
                'dp.nip_dosen_penguji2'

            )
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $tanggal = Carbon::parse($data->tanggal_semhas)->translatedFormat('l, d F Y');
        return view('mahasiswa.jadwal-semhas', compact('data', 'tanggal'));
    }

    // halaman tanggal sidang ATAU berita acara sidang meja hijau
    public function jadwal_sidang()
    {
        $data   = DB::table('mahasiswas as m')
            ->join('skripsis as s', 'm.nim', '=', 's.nim')
            ->join('v_dosbing as d', 'm.nim', '=', 'd.nim')
            ->join('v_dosen_penguji as dp', 'm.nim', '=', 'dp.nim')
            ->join('jadwal_sidangs as j', 'm.nim', '=', 'j.nim')
            ->select(
                'm.nim',
                'm.nama',
                's.judul_skripsi',
                'j.tanggal_sidang',
                'd.nama_dosbing1',
                'd.nip_dosbing1',
                'd.nama_dosbing2',
                'd.nip_dosbing2',
                'dp.nama_dosen_penguji1',
                'dp.nip_dosen_penguji1',
                'dp.nama_dosen_penguji2',
                'dp.nip_dosen_penguji2'
            )
            ->where('m.id_user', '=', Auth::user()->id)
            ->first();
        $tanggal    = Carbon::parse($data->tanggal_sidang)->translatedFormat('l, d F Y');
        return view('mahasiswa/jadwal-sidang', compact('data', 'tanggal'));
    }

    // halaman ke file pdf calon pembimbing
    public function calon_pembimbing($id)
    {
        $id_ilmu = AjukanBidangIlmu::where('id_user', $id)->select('bidang_ilmu1', 'bidang_ilmu2')->first();
        $bidang_ilmu1 = BidangIlmu::where('id', $id_ilmu->bidang_ilmu1)->select('bidang_ilmu')->first();
        $bidang_ilmu2 = BidangIlmu::where('id', $id_ilmu->bidang_ilmu2)->select('bidang_ilmu')->first();
        // $bidang_ilmu1 = DB::table('bidang_ilmus')->where('id', 1)->first();
        $ketua = User::where('status', 'kepala_prodi')
            ->join('dosens', 'users.id', '=', 'dosens.id_user')
            ->select('users.id', 'dosens.nama', 'dosens.nip')
            ->first();

        $mhs = Mahasiswa::where('id_user', $id)->select('nim', 'nama')->first();
        $profile   = DB::table('mahasiswas as m')
            ->leftJoin('skripsis as s', 'm.nim', '=', 's.nim')
            ->select('m.nim', 'm.nama', 'm.angkatan', 'm.foto', 'm.status', 's.judul_skripsi')
            ->where('id_user', Auth::user()->id)
            ->first();
        // return $bidang_ilmu;
        return view('mahasiswa.calon_pembimbing', compact('mhs', 'ketua', 'profile', 'bidang_ilmu1', 'bidang_ilmu2'));
    }

    // ajukan exum
    public function ajukan_exum(Request $request)
    {
        $nim = Mahasiswa::where('id_user', $request->input('id'))->select('nim')->first();
        $nama = Mahasiswa::where('id_user', $request->input('id'))->select('nama')->first();
        $new_name = $nim->nim . '.pdf';
        $request->file('exum')->storeAs('exums', $new_name);

        $exum = new Exum;
        $exum->nim = $nim->nim;
        $exum->nama_mhs = $nama->nama;
        $exum->status = 'Belum Diperiksa';
        $exum->file_exum = $new_name;
        $exum->save();

        if ($exum) {
            return redirect('/mahasiswa/pra_sempro')->with('success_exum', 'Berhasil mengajukan exum');
        } else {
            return redirect('/mahasiswa/pra_sempro')->with('failed_exum', 'Gagal mengajukan exum');
        }
    }

    // download exum
    public function download_exum()
    {
        $id = Auth::user()->id;
        $mhs = Mahasiswa::where('id_user', $id)->select('nim')->first();
        $exum = Exum::where('nim', $mhs->nim)->select('file_exum')->first();
        // return $exum->file_exum;
        if (Storage::disk('public')->exists('exums/' . $exum->file_exum)) {
            $path = Storage::disk('public')->path('exums/' . $exum->file_exum);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path)
            ]);
        }

        // $id = Auth::user()->id;

        // $file = public_path() . "/main/files/exums/" . $exum->file_exum;
        // $headers = array('Content-Type=> application/pdf',);
        // response()->download($file, $exum->file_exum, $headers);

        if ($exum->file_exum) {
            return redirect('/mahasiswa/pra_sempro')->with('success_download_exum', 'Berhasil mengunduh exum');
        } else {
            return redirect('/mahasiswa/pra_sempro')->with('failed_download_exum', 'Gagal mengunduh exum');
        }
    }

    public function format_jurnal()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/main/files/format_jurnal.pdf";
        $headers = array('Content-Type=> application/pdf',);
        return response()->download($file, 'format_jurnal.pdf', $headers);
        return redirect('/mahasiswa/pasca_meja_hijau');
    }

    public function profile()
    {
        return view('mahasiswa.profile');
    }

    public function ajukan_bidang_ilmu(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'bidang_ilmu1' => 'required',
            'bidang_ilmu2' => 'required',
        ]);

        $query = DB::table('ajukan_bidang_ilmus')->insert([
            'id_user' => $request->input('id'),
            'bidang_ilmu1' => $request->input('bidang_ilmu1'),
            'bidang_ilmu2' => $request->input('bidang_ilmu2')
        ]);

        if ($query) {
            return redirect('/mahasiswa/pra_sempro')->with('success_ilmu', 'Berhasil mengajukan bidang ilmu!');
        } else {
            return redirect('/mahasiswa/profile')->with('failed_ilmu', 'Gagal mengajukan bidang ilmu!');
        }
    }

    public function update_profile(Request $request)
    {
        $validated = $request->validate([
            'nama'  => 'required|min:5|max:255',
            'new_email' => 'required|min:10|max:255|email',
        ]);


        if ($request->new_email != $request->old_email) {
            if ((User::where('email', $request->new_email)->count()) > 0) {
                return redirect('/mahasiswa/profile')->with('prohibited', 'Email sudah terdaftar!');
            } else {
                $mhs = Mahasiswa::find(Auth::user()->mhs->nim);
                Mahasiswa::where('nim', Auth::user()->mhs->nim)->update([
                    'nama' => $request->nama,
                ]);

                User::where('id', Auth::user()->id)->update([
                    'email' => $request->new_email,
                ]);

                if ($request->old_foto != NULL) {
                    if ($request->hasFile('new_foto')) {
                        //memeriksa validasi inputan file gambar
                        $this->validate($request, [
                            'new_foto' => 'required|image|mimes:jpg,png,jpeg|max:4096'
                        ]);

                        if (File::exists(public_path('main/photos/' . $request->old_foto))) {
                            File::delete(public_path('main/photos/' . $request->old_foto));
                        }

                        $location = public_path('/main/photos');
                        $request->file('new_foto')->move($location, $request->file('foto')->getClientOriginalName());
                        $mhs->foto = $request->file('foto')->getClientOriginalName();
                        $mhs->save();
                    }
                } else {
                    if ($request->hasFile('new_foto')) {
                        //memeriksa validasi inputan file gambar
                        $this->validate($request, [
                            'new_foto' => 'required|image|mimes:jpg,png,jpeg|max:4096'
                        ]);

                        $location = public_path('/main/photos');
                        $request->file('new_foto')->move($location, $request->file('new_foto')->getClientOriginalName());
                        $mhs->foto = $request->file('new_foto')->getClientOriginalName();
                        $mhs->save();
                    }
                }

                return redirect('/mahasiswa/profile')->with('status', 'Profile anda berhasil diperbaharui!');
            }
        } else {
            $mhs = Mahasiswa::find(Auth::user()->mhs->nim);
            Mahasiswa::where('nim', Auth::user()->mhs->nim)->update([
                'nama' => $request->nama,
            ]);

            if ($request->old_foto != NULL) {
                if ($request->hasFile('new_foto')) {
                    //memeriksa validasi inputan file gambar
                    $this->validate($request, [
                        'new_foto' => 'required|image|mimes:jpg,png,jpeg|max:4096'
                    ]);

                    if (File::exists(public_path('main/photos/' . $request->old_foto))) {
                        File::delete(public_path('main/photos/' . $request->old_foto));
                    }

                    $location = public_path('/main/photos');
                    $request->file('new_foto')->move($location, $request->file('new_foto')->getClientOriginalName());
                    $mhs->foto = $request->file('new_foto')->getClientOriginalName();
                    $mhs->save();
                } else {
                    $mhs->foto = $request->old_foto;
                    $mhs->save();
                }
            } else {
                if ($request->hasFile('new_foto')) {
                    //memeriksa validasi inputan file gambar
                    $this->validate($request, [
                        'new_foto' => 'required|image|mimes:jpg,png,jpeg|max:4096'
                    ]);

                    $location = public_path('/main/photos');
                    $request->file('new_foto')->move($location, $request->file('new_foto')->getClientOriginalName());
                    $mhs->foto = $request->file('new_foto')->getClientOriginalName();
                    $mhs->save();
                } else {
                    $mhs->foto = $request->old_foto;
                    $mhs->save();
                }
            }
            return redirect('/mahasiswa/profile')->with('status', 'Profile anda berhasil diperbaharui!');
        }
    }
}
