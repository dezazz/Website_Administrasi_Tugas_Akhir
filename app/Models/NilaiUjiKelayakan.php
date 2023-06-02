<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjiKelayakan extends Model
{
    use HasFactory;
    protected $table = 'nilai_uji_kelayakans';
    public $timestamps = false;
}
