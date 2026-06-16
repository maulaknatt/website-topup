<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengirim;
use App\Models\Metode_pembayaran;
use App\Models\Kritik_saran;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Menampilkan form dengan data metode pembayaran
    public function showForm()
    {
        $metodePembayarans = Metode_pembayaran::all();
        return view('welcome', compact('metodePembayarans'));
    }

    // Menangani pengiriman form
    public function submitAll(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'metode_id' => 'required|exists:metode_pembayarans,id',
            'total_pembayaran' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'isi_pesan' => 'required|string',
            'kepuasan' => 'required|in:1,2,3,4,5',
            'status_tanggapan' => 'required|in:belum_ditanggapi,ditanggapi',
        ]);

        // Simpan data Pengirim
        $pengirim = Pengirim::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        // Simpan data Transaksi
        $transaksi = Transaksi::create([
            'pengirim_id' => $pengirim->pengirim_id,
            'metode_id' => $request->metode_id,
            'total_pembayaran' => $request->total_pembayaran,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'status_pembayaran' => $request->status_pembayaran
        ]);

        // Simpan data Kritik & Saran
        Kritik_saran::create([
            'pengirim_id' => $pengirim->pengirim_id,
            'transaksi_id' => $transaksi->transaksi_id,
            'isi_pesan' => $request->isi_pesan,
            'kepuasan' => $request->kepuasan,
            'status_tanggapan' => $request->status_tanggapan,

        ]);

        // Redirect atau respon setelah data berhasil disimpan
        return redirect()->route('form.show')->with('success', 'Form berhasil dikirim.');
    }
}
