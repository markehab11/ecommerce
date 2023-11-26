<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    // public function reviews(){
    //     return $this->morphMany(Review::class, 'reviewable');
    // }
    // public function price(){
    //     return $this->hasOne(Price::class);
    // }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function detail(){
        return $this->hasMany(Detail::class);
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
