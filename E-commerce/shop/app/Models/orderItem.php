<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $primaryKey = 'id';

    public function order()
    {
        return $this->belongsTo(order::class, "order_id","id");
    }
}
