<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $appends = ['image_url'];

    public function category()
    {   
      
        return $this->belongsTo(Category::class);
    }
    

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function getImageurlAttribute()
    {
        if(!empty($this->attributes['images'])){
            return asset('public/assets/images/product/' . $this->attributes['images']);
         }
        else{
            return asset('public/assets/images/default.jpg');
            }
    
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    
}
