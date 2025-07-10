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
            $table->id('Product_id');
            $table->string('Product_image')->default('No image');
            $table->string('Product_title', 20)->default('No Title');
            $table->string('Product_details')->default('No details');
            $table->string('Product_colors')->default('No colors');
            $table->float('Product_price')->default(0.00);
            $table->float('Product_old_price')->default(0.00);
            $table->float('Product_discount')->default(0.00);
            $table->string('Product_catagory', 30)->default('No catagory');
            $table->boolean('Is_story')->default(false);
            $table->string('Story_sub_title', 20)->default('No sub title');
            $table->integer('Number_of_sells')->default(0);
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
