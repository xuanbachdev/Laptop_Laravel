<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Cpu extends Model
{
    use HasFactory, softDeletes;
    public $timestamps = false;
    protected $guarded = [];

    public function product(){
        return $this->hasMany(Product::class,"cpu_id");
    }
}

