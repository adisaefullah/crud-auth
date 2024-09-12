<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model (opsional)
    protected $table = 'posts';

    // Tentukan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'title',
        'content',
        'image',
        'file',
    ];


    // Tentukan kolom-kolom yang tidak bisa diisi secara massal (opsional)
    // protected $guarded = [];

    // Jika Anda menggunakan tipe data tanggal untuk kolom tertentu, tambahkan:
    protected $dates = ['created_at', 'updated_at'];

    // Jika Anda tidak ingin Eloquent otomatis menangani kolom timestamps, Anda dapat menonaktifkannya:
    // public $timestamps = false;
}

