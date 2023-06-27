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
        Schema::create('facturas_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('idFacturas');
            $table->foreign('idFacturas')->references('idFacturas')->on('facturas')->onDelete('cascade');
            $table->unsignedInteger('idProducto');
            $table->foreign('idProducto')->references('idProducto')->on('productos')->onDelete('cascade');
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_productos');

    }
};
