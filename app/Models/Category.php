<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Get the contacts for the category.
     */
    public function contacts()
    {   
        return $this->hasMany(Contact::class);
    }
}
