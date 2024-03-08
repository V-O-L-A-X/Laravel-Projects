<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;
    protected $table = 'shipping_charges';
    protected $primaryKey = 'id';

    public function country()
    {
        return $this->belongsTo(country::class, "country_id","id");
    }
}
