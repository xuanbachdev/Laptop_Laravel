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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('code');
            $table->integer('type')->default(1);
            $table->double("discount_percent")->nullable()->default(0);
            $table->integer('discount_amount')->nullable()->default(0);
            $table->dateTime("start_day");
            $table->dateTime("expired_at");
            $table->text("content")->nullable();
            $table->string("url")->nullable();
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
        Schema::dropIfExists('discounts');
    }
};
