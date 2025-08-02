<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosmetic extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'category_id',
        'expiration_date',
        'emoji',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
