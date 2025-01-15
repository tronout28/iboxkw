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
            $table->text('description');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('category')->nullable();
            $table->bigInteger('price');
            $table->string('image')->nullable();
            $table->enum('requested',['non-accepted','accepted','rejected'])->default('non-accepted');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->unsignedBigInteger('user_id')->nullable();

            

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
