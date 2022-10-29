<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn')->nullable();
            $table->string('account')->nullable();
            $table->string('amount')->nullable();
            $table->string('reference')->nullable();
            $table->string('origin')->nullable();
            $table->string('mode')->nullable();
            $table->string('session')->nullable();
            $table->string('ussd_code')->nullable();
            $table->timestamps();
        });
    }
}
