<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('timezone_code')->nullable();
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
        Schema::drop('phone_book');
    }
}
