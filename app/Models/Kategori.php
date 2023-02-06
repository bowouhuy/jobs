<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    protected $guarded = [];

    public function subkategori(){
        return $this->hasMany('App\Models\Subkategori', 'kategori_id');
    }


}
