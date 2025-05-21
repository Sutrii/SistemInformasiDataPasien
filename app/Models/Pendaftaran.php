<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama', 'no_rm', 'pendaftaran_date', 'no_pendaftaran'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_rm', 'no_rm');
    }
}
