<?php

use App\Concerns\Enums\Status;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Información general
            $table->string('code');
            $table->string('status')->nullable()->default(Status::PENDING_APPROVAL->value);
            $table->integer('register_progress')->nullable()->default(0);
            $table->integer('current_step')->nullable()->default(0);

            $table->string('name');
            $table->string('last_name');
            $table->string('business');
            $table->string('economy');
            $table->string('business_description');
            $table->string('role');
            $table->longText('biography');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->rememberToken();

            // Información de participante (Opcional)
            $table->string('attendee_name')->nullable()->default(null);
            $table->string('attendee_email')->nullable()->default(null);
            $table->boolean('send_copy_of_registration')->nullable()->default(false);
            $table->boolean('accept_terms_and_conditions')->nullable()->default(false);

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
