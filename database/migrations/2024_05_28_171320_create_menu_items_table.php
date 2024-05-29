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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('type');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->boolean('only_logged')->default(false);
            $table->unsignedBigInteger('menu_id')->nullable()->default(null);
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
