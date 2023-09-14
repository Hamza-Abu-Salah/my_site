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
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->date('Birthday');
            $table->string('Mail');
            $table->string('Phone');
            $table->string('Address_en');
            $table->string('Address_ar')->nullable();
            $table->string('Nationality_en');
            $table->string('Nationality_ar')->nullable();
            $table->string('job_title_en');
            $table->string('job_title_ar')->nullable();
            $table->string('job_description_en');
            $table->string('job_description_ar')->nullable();
            $table->mediumText('about_en');
            $table->mediumText('about_ar')->nullable();
            $table->string('cv');
            $table->string('first_photo');
            $table->string('second_photo');
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
        Schema::dropIfExists('about_mes');
    }
};
