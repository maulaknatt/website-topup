<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metode_pembayaran extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nama_metode', 'deskripsi'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
