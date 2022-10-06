<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, softDeletes;
    public $timestamps = false;
    protected $guarded = [];


    public function product(){
        return $this->hasMany(Product::class,"id","product_id")->withTrashed();
    }
    public function customer(){
        return $this->belongsTo(Customer::class,"customer_id");
    }
}
