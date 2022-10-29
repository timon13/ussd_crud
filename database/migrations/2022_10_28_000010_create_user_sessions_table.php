<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session')->nullable();
            $table->string('service_code')->nullable();
            $table->string('msisdn')->nullable();
            $table->timestamps();
        });
    }
}
