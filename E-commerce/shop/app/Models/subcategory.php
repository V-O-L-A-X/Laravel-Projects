<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $primaryKey = 'id';
    public function category()
    {
        return $this->belongsTo(category::class, "category_id","id");
    }

    public function product()
    {
        return $this->hasMany(product::class,"sub_category_id","id");
    }
}
