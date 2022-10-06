<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, softDeletes;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "orders";

    public function detail()
    {
        return $this->hasMany(OrderDetail::class, "order_id");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }

}
