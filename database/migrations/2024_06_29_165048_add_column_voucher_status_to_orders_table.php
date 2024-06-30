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
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('voucher_comment')->nullable()->default(null)->after('status');
            $table->string('voucher_status')->nullable()->default(\App\Concerns\Enums\Status::PENDING->value)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('voucher_comment');
            $table->dropColumn('voucher_status');
        });
    }
};
