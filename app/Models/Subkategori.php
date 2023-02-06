<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    protected $table = 'subkategori';

    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo('App\Models\Kategori');
    }
}
