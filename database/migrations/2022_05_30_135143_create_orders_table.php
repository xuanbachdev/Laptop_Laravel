<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('order_code')->unique();
            $table->integer("status")->default(0)->comment('0: Chờ xác nhận, 1: Đã xác nhận, 2: Đang giao hàng, 3: Đã giao hàng, 4: Đã hủy, 5: Đã xóa');//4 = đã hủy, 0 = chờ xác nhận, 1 = đã xác nhận, 2 = đang giao hàng, 3 = đã giao hàng, 5 = đã xóa
            $table->unsignedInteger("customer_id");
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
//            $table->unsignedInteger("admin_id")->nullable()->default(1);
            $table->dateTime('finished_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
