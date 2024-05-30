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
            $table->longText('flight_details')->nullable()->default(null)->after('exit_time');
            $table->boolean('flight_free_transportation')->nullable()->default(false)->after('exit_time');
            $table->string('flight_contact_number')->nullable()->default(null)->after('exit_time');
            $table->boolean('flight_email_sent')->nullable()->default(false)->after('exit_time');
            $table->integer('flight_hotel_step')->nullable()->default(1)->after('exit_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('flight_details');
            $table->dropColumn('flight_free_transportation');
            $table->dropColumn('flight_contact_number');
            $table->dropColumn('flight_email_sent');
            $table->dropColumn('flight_hotel_step');
        });
    }
};
