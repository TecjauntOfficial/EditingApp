<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'image',


    ];

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
}
