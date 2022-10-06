<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, softDeletes;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'coupons';

    public function detail()
    {
        return $this->hasMany(Coupon::class, 'id');
    }
}
