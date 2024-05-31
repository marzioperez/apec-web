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
            $table->boolean('send_invitation_to_companion')->nullable()->default(false)->after('companion_amount');
            $table->boolean('send_invitation_to_staff')->nullable()->default(false)->after('staff_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('send_invitation_to_companion');
            $table->dropColumn('send_invitation_to_staff');
        });
    }
};
