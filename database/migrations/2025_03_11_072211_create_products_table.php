<?php

// database/migrations/2025_03_11_000002_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('image')->nullable(); // menyimpan path gambar
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
