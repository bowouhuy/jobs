<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasaimage extends Model
{
    use HasFactory;
    protected $table = 'jasa_images';

    protected $fillable = [
        'jasa_id',
        'filename',
        'url',
    ];
}
