<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'order_id', // Add this line
        'status',
        'jasa_id',
        'paket_id',
        'customer_id',
        'mitra_id',
        'attachment',
        'description'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function orderHistory()
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
