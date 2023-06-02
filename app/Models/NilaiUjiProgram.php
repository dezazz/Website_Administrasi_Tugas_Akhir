<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class NilaiUjiProgram extends Model
{
    use HasFactory;
    protected $table = 'nilai_uji_programs';
    public $timestamps = false;

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])->translated('l, d F Y');
    }
}
