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
        Schema::create('schedule_day_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable()->default(null);
            $table->time('start');
            $table->time('end')->nullable()->default(null);
            $table->unsignedBigInteger('schedule_day_id')->nullable()->default(null);
            $table->integer('order');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_day_activities');
    }
};
