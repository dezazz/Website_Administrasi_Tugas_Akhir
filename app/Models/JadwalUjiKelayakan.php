<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class JadwalUjiKelayakan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_uji_kelayakans';
    public $timestamps = false;

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])
            ->translatedFormat('l, d F Y');
    }
}
