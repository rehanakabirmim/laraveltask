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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->string('symbology');
            $table->string('brand_id');
            $table->string('category_id');
            $table->string('unit_id');
            $table->string('attachment_id');
            $table->string('price');
            $table->string('qty');
            $table->string('alert_qty');
            $table->string('tax_id');
            $table->enum('is_active', ['0', '1'])->default('1');

            $table->text('description')->nullable();
            
           

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
