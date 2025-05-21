<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date', 'foto'
    ];
}
