<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productRating extends Model
{
    use HasFactory;
    protected $table = 'product_ratings';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(product::class, "product_id","id");
    }
}
