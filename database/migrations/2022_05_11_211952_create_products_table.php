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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("slug")->unique();
            $table->integer('user_id');
            $table->integer('category_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('quantity');
            $table->string('feature_image_name')->nullable();
            $table->string('feature_image_path')->nullable();
            $table->string("sku")->unique();
            $table->string("memory");
            $table->string("memory_capacity");
            $table->string("ssd_storage")->nullable();
            $table->string("ssd_capacity")->nullable();
            $table->string("hdd_storage")->nullable();
            $table->string("hdd_capacity")->nullable();
            $table->unsignedBigInteger("cpu")->nullable();
            $table->unsignedBigInteger("gpu")->nullable();
            $table->string("screen_type")->nullable();
            $table->string("screen_size")->nullable();
            $table->string("screen_detail")->nullable();
            $table->string("case_material")->nullable();
            $table->string('webcam')->nullable();
            $table->string("bluetooth")->nullable();
            $table->string("wifi")->nullable();
            $table->string("connection_port")->nullable();
            $table->string("keyboard")->nullable();
            $table->string("battery")->nullable();
            $table->string("color")->nullable();
            $table->string("addition")->nullable();
            $table->string("operating_system")->nullable();
            $table->mediumText("description");
            $table->unsignedBigInteger("status")->nullable()->default(1);
            $table->integer('price');
            $table->double('sale_price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('size')->nullable();
            $table->date('start_sale')->nullable();
            $table->date('end_sale')->nullable();
            $table->string('weight')->nullable();
            $table->string('package')->nullable();
            $table->string('warranty_time')->nullable();
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
        Schema::dropIfExists('products');
    }
};
