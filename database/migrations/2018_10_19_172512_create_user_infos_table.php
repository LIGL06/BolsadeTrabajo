<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->index()->unsigned();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->string('fName');
            $table->string('lName');
            $table->date('doB');
            $table->enum('civilStatus',['casado','soltero','otro']);
            $table->string('address');
            $table->string('pictureUrl');
            $table->boolean('professional');
            $table->boolean('handyCap');
            $table->string('uniqueKey')->unique();
            $table->string('socialKey')->unique();
            $table->decimal('salary',6,2);
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
        Schema::dropIfExists('user_infos');
    }
}