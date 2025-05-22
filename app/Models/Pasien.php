<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik', 'nama', 'no_rm', 'alamat', 'agama', 'tanggal_lahir', 'register_date', 'foto'
    ];

    public function pendaftarans()
    {
        return $this->hasMany(\App\Models\Pendaftaran::class, 'no_rm', 'no_rm');
    }

    public function getNoRmAttribute($value)
    {
        return trim($value);
    }

    public function latestPendaftaran()
    {
        return $this->hasOne(\App\Models\Pendaftaran::class, 'no_rm', 'no_rm')
                    ->withTrashed()
                    ->latestOfMany('pendaftaran_date');
    }
}
