<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session')->nullable();
            $table->string('service_code')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('ussd_string')->nullable();
            $table->string('level')->nullable();
            $table->string('title')->nullable();
            $table->string('menu')->nullable();
            $table->string('selection')->nullable();
            $table->string('min_val')->nullable();
            $table->string('max_val')->nullable();
            $table->string('session_date')->nullable();
            $table->timestamps();
        });
    }
}
