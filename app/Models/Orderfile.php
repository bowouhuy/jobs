<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderfile extends Model
{
    use HasFactory;
    protected $table = 'orderfile';

    protected $fillable = [
        'transaksi_id',
        'filename',
        'url',
    ];
}
