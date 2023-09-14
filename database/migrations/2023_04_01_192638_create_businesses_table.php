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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('sub_title_en');
            $table->string('sub_title_ar')->nullable();
            $table->string('link');
            $table->foreignId('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image');
            $table->enum('status' , ['ACTIVE' , 'NACTIVE']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};
