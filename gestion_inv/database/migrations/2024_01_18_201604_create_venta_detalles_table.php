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
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id('dventa_id');
             $table->unsignedBigInteger('venta_id');
            $table->foreign('venta_id')->references('venta_id')->on('ventas');
             $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')->references('prod_id')->on('productos');
            $table->float('dventa_precio');
            $table->integer('dventa_cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
