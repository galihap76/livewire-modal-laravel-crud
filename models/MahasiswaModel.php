<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_mahasiswa';
    protected $primaryKey = 'nim';

    protected $fillable = [
        'nama',
        'jurusan'
    ];
    public $timestamps = false;
}
