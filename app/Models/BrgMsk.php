<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgMsk extends Model
{
    use HasFactory;

    protected $table = 'brg_masuk';

    protected $fillable = [
        'no_brg_masuk',
        'id_barang',
        'id_user',
        'jml_brg_masuk',
        'tgl_brg_masuk',
        'total',
        'created_at',
        'updated_at',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
