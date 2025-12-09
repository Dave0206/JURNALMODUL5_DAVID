<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    
    //TODO
    //Tambahkan fillable model Mahasiswa sesuai dengan variabel yang ada
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'fakultas'
    ];
}