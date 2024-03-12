<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'Comment';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function loaitin()
    {
        return $this->belongsTo(Tintuc::class, "idTinTuc","id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,"idUser","id");
    }
}
