<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productimage extends Model
{
    use HasFactory;
    protected $table = 'products_images';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(product::class, "product_id","id");
    }
   
}
