<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->float('valor');
            $table->timestamps();
        });

        DB::table('produtos')->insert(
            array(
                [
                    'descricao' => 'Bota Alexander McQueen Skull Cut-Out',
                    'valor' => 1399.93
                ],
                [
                    'descricao' => 'Saia Derek Lam Paêtes Bicolor',
                    'valor' => 374.90
                ],
                [
                    'descricao' => 'Bolsa Dolce & Gabbana Marrom Mescla',
                    'valor' => 840.00
                ],
                [
                    'descricao' => 'Casaco Dolce & Gabbana Cardigã Marrom',
                    'valor' => 809.10
                ],
                [
                    'descricao' => 'Cinto Yves Saint Laurent Couro Marrom',
                    'valor' => 2399.90
                ],
                [
                    'descricao' => 'Bolsa Valentino Rockstud Raffia Tote Medium',
                    'valor' => 5240.00
                ],
                [
                    'descricao' => 'Bolsa Valentino Va Va Voom Tote Bege',
                    'valor' => 10990.83
                ],
                [
                    'descricao' => 'Tênis Chanel Logo Bicolor',
                    'valor' => 2390.99
                ],
                [
                    'descricao' => 'Sapato Chanel Cap Toe CC P&B',
                    'valor' => 4990.00
                ],
                [
                    'descricao' => 'Óculos Chloé CE100SL Nerine Aviator Marrom',
                    'valor' => 999.90
                ],                
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
