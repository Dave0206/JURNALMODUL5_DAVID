<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    //TODO
    //Tambahkan fillable model MataKuliah sesuai dengan variabel yang ada
    protected $fillable = [
        'nama',
        'kode',
        'sks'
    ];
}