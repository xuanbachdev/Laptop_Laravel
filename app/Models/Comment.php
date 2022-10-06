<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function Customer(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
