<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';

    protected $fillable = [
        'jasa_id',
        'nama',
        'deskripsi',
        'estimasi',
        'harga',
    ];

    public function jasa(){
        return $this->belongsTo('App\Models\Jasa', 'jasa_id', 'id');
    }
}
