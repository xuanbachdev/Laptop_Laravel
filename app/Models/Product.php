<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "products";
    public $timestamps = false;
    protected $guarded =[];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id') -> withTimeStamps();
    }

    public function cpu(){
        return $this->belongsTo(Cpu::class,"cpu_id")->withTrashed();
    }
    public function gpu(){
        return $this->belongsTo(Gpu::class,"gpu_id")->withTrashed();
    }

//    public function discount(){
//        return $this->hasOne(Coupon::class,'id');
//    }
}
