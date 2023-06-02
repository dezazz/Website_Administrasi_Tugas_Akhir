<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaLaboratorium extends Model
{
    use HasFactory;
    protected $table = 'kepala_laboratoriums';
    public $timestamps = false;
}
