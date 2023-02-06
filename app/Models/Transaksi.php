<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'customer_id',
        'mitra_id',
        'jasa_id',
        'paket_id',
        'amount',
        'deskripsi',
        'kode_invoice',
        'tanggal_invoice',
        'tanggal_expired',
        'tanggal_transaksi',
        'bukti_transaksi',
        'status',
    ];

    public function jasa(){
        return $this->belongsTo('App\Models\Jasa', 'jasa_id', 'id');
    }
}
