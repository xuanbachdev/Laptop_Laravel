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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table -> string('title');
            $table -> string('slug');
            $table -> string('title_image_name');
            $table -> string('title_image_path');
            $table -> string('content');
            $table->string("meta_keyword")->nullable();
            $table->text("meta_description")->nullable();
            $table -> integer('user_id');
            $table->integer("view")->default(0);
            $table -> boolean('status')->default(0)->comment('0: draft, 1: saved, 2: published');
            $table->timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
