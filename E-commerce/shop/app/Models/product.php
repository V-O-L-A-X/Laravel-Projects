<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    public function category()
    {
        return $this->belongsTo(category::class, "category_id","id");
    }
    public function subcat()
    {
        return $this->belongsTo(subcategory::class, "sub_category_id","id");
    }
    public function brand()
    {
        return $this->belongsTo(brand::class, "brand_id","id");
    }
    public function productimage()
    {
        return $this->hasMany(productimage::class,"product_id","id");
    }

    public function productrating()
    {
        return $this->hasMany(productRating::class,"product_id","id")->where('status',1);
    }


}
