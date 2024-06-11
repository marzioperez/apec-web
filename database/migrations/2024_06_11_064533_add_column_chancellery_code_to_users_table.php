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
            $table->json('chancellery_receive_response')->nullable()->after('lock_fields');
            $table->json('chancellery_sent_response')->nullable()->after('lock_fields');
            $table->string('chancellery_code')->nullable()->after('lock_fields');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('chancellery_receive_response');
            $table->dropColumn('chancellery_sent_response');
            $table->dropColumn('chancellery_code');
        });
    }
};
