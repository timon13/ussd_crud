<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUssdMenusTable extends Migration
{
    public function up()
    {
        Schema::table('ussd_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('ussd_id')->nullable();
            $table->foreign('ussd_id', 'ussd_fk_7540365')->references('id')->on('ussds');
        });
    }
}
