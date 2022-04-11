<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('email');
            $table->bigInteger('cupom_id')->nullable()->unsigned();            
            $table->foreign('cupom_id')->references('id')->on('cupoms')->onDelete('cascade');            
            $table->bigInteger('forma_pagamento_id')->unsigned();            
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos')->onDelete('cascade');
            $table->float('valor_desconto');
            $table->float('total');            
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
        Schema::dropIfExists('checkouts');
    }
}
