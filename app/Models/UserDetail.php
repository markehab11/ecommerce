<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'apartment',
        'street',
        'city',
        'country',
        'state',
        'postal_code',
        'floor',
        'building',
        'shipping_method',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
