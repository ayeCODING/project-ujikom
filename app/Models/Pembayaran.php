<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Menyesuaikan nama tabel
    protected $table = 'pembayarans';

    // Menentukan primary key
    protected $primaryKey = 'pembayaran_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama_pembayaran',
    ];

    // Aktifkan timestamps (created_at & updated_at)
    public $timestamps = true;
}
