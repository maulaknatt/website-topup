<?php

namespace App\Models;

use App\Models\Pengirim;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kritik_saran extends Model
{
    use HasFactory;
    protected $primaryKey = 'kritik_id';
    protected $fillable = [
        'user_id',
        'transaksi_id',
        'isi_pesan',
        'kepuasan',
        'status_tanggapan',
        'waktu_input'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'transaksi_id');
    }
}
