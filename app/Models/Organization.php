<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Organization belongs to a User
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
