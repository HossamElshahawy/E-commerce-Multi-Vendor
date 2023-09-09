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
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->string('photo')->nullable();

            $table->float('price')->default(0);
            $table->float('offer_price')->default(0);
            $table->float('discount')->default(0);
            $table->string('size');

            $table->enum('condition',['new','popular','winter'])->default('new');

            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->enum('status',['active','inactive'])->default('active');

            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('child_category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('SET NULL');


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
