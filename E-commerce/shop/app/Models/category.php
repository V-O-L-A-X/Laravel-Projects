<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public function subcat()
    {
        return $this->hasMany(subcategory::class,"category_id","id");
    }
    public function product()
    {
        return $this->hasManyThrough(product::class, subcategory::class,"category_id","sub_category_id","id");
    }
}
