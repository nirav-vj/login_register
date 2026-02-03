<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'interests',
        'skills',
        'skills',
        'images',
        'category_id',
        'user_id'
    ];

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the category that owns the contact.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'interests' => 'array',
        'skills' => 'array',
        'images' => 'array',
    ];
}
