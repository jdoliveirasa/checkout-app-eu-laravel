<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCupomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupoms', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('codigo');
            $table->integer('desconto');
            $table->timestamps();
        });

        DB::table('cupoms')->insert(
            array(
                [
                    'descricao' => 'Promoção Primeira Compra',
                    'codigo' => 'CUPSUII8854', 
                    'desconto' => 5, 
                ],
                [
                    'descricao' => 'Desconto de 10%',
                    'codigo' => 'CUP10TOP54',
                    'desconto' => 10,
                ],
                [
                    'descricao' => '50% OFF Black Friday',
                    'codigo' => 'CUPBLCFDY1950',
                    'desconto' => 50,
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
        Schema::dropIfExists('cupoms');
    }
}
