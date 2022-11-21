<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUssdsTable extends Migration
{
    public function up()
    {
        Schema::create('ussds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ussd_code')->unique();
            $table->string('name');
            $table->timestamps();
        });
    }
}
