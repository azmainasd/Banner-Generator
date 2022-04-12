<?php

namespace App\Models;

use App\Models\Product;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'impressions',
        'clicks'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
