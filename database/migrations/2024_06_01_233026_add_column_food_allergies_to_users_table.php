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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('food_allergies')->nullable()->default(null)->after('require_special_assistance');
            $table->boolean('require_special_assistance')->nullable()->default(false)->change();
            $table->longText('special_assistance_details')->nullable()->default(null)->after('require_special_assistance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('food_allergies');
            $table->longText('require_special_assistance')->nullable()->default(null)->change();
            $table->dropColumn('special_assistance_details');
        });
    }
};
