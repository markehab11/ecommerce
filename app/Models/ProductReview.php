<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'review',
        'name',
        'email',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
