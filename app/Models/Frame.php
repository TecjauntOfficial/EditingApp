<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'frame_img'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
