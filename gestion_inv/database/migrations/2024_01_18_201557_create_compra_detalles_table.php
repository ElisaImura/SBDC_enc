<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->id('dcompra_id');
             $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('compra_id')->on('compras');
             $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('prod_id')->on('productos');
            $table->float('dcompra_precio');
            $table->integer('dcompra_cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_detalles');
    }
};
