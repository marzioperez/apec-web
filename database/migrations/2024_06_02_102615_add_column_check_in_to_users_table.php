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
            $table->date('hotel_check_in_date')->nullable()->default(null)->after('hotel_conditions_and_payment');
            $table->time('hotel_check_in_hour')->nullable()->default(null)->after('hotel_conditions_and_payment');
            $table->date('hotel_check_out_date')->nullable()->default(null)->after('hotel_conditions_and_payment');
            $table->time('hotel_check_out_hour')->nullable()->default(null)->after('hotel_conditions_and_payment');
            $table->longText('hotel_details')->nullable()->default(null)->after('hotel_conditions_and_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('hotel_check_in_date');
            $table->dropColumn('hotel_check_in_hour');
            $table->dropColumn('hotel_check_out_date');
            $table->dropColumn('hotel_check_out_hour');
            $table->dropColumn('hotel_details');
        });
    }
};
