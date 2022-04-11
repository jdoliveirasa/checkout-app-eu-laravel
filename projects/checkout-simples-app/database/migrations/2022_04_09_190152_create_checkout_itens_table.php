<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_itens', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->bigInteger('checkout_id')->unsigned();            
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
            $table->bigInteger('produto_id')->unsigned();            
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
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
        Schema::dropIfExists('checkout_itens');
    }
}
