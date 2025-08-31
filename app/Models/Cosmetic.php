<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosmetic extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'color_product_code',
        'category_id',
        'expiration_date',
        'memo',
        'emoji',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoredBy()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites')->withTimestamps();
    }
}
