<?php

namespace App\Models;

use App\Models\Category;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'image_name',
        'image_path',
        'url',
        'price',
        'title'
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
