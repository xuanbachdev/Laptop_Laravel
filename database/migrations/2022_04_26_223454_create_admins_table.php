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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('avatar_path')->nullable()->default('images/avatar/default-avatar.jpg');
            $table->string('avatar_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('gender')->comment('1: Nam, 2: Nữ');
            $table->date('birthday')->nullable()->useCurrent();
            $table->string('address')->nullable();
            $table->string("remember_token")->nullable();
            $table->integer("status")->default(1)->comment('1: Đang làm việc, 2: Đã nghỉ việc')->nullable();
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
        Schema::dropIfExists('admins');
    }
};
