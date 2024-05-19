<?php

use App\Concerns\Enums\Status;
use App\Concerns\Enums\Types;
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
            $table->string('code')->nullable()->default(null);
            $table->string('type')->nullable()->default(Types::PARTICIPANT->value);

            // Información general
            $table->string('status')->nullable()->default(Status::PENDING_APPROVAL->value);
            $table->integer('register_progress')->nullable()->default(0);
            $table->integer('current_step')->nullable()->default(0);

            $table->string('title')->nullable()->default(null);
            $table->string('name');
            $table->string('last_name');
            $table->string('gender')->nullable()->default(null);
            $table->string('document_type')->nullable()->default(null);
            $table->string('document_number')->nullable()->default(null);
            $table->string('business')->nullable()->default(null);
            $table->string('economy')->nullable()->default(null);
            $table->longText('business_description')->nullable()->default(null);
            $table->string('business_email')->nullable()->default(null);
            $table->string('role')->nullable()->default(null);
            $table->string('area')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('zip_code')->nullable()->default(null);
            $table->string('business_phone_number')->nullable()->default(null);
            $table->longText('biography')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(null);

            $table->date('date_of_issue')->nullable()->default(null);
            $table->string('place_of_issue')->nullable()->default(null);
            $table->date('date_of_birth')->nullable()->default(null);
            $table->string('nationality')->nullable()->default(null);
            $table->string('city_of_permanent_residency')->nullable()->default(null);

            $table->string('types_of_food')->nullable()->default(null);
            $table->longText('require_special_assistance')->nullable()->default(null);

            $table->boolean('with_companion')->nullable()->default(false);
            $table->boolean('with_staff')->nullable()->default(false);

            $table->string('blood_type')->nullable()->default(null);
            $table->boolean('allergies')->nullable()->default(false);
            $table->longText('allergy_details')->nullable()->default(null);
            $table->json('vaccines')->nullable()->default(null);
            $table->longText('medical_others')->nullable()->default(null);
            $table->boolean('medical_treatment')->nullable()->default(false);
            $table->longText('medical_treatment_details')->nullable()->default(null);
            $table->string('taking_any_medication')->nullable()->default(null);
            $table->string('chemical_name')->nullable()->default(null);
            $table->string('brand_trade_name')->nullable()->default(null);
            $table->string('dosis')->nullable()->default(null);
            $table->string('frequency')->nullable()->default(null);

            $table->string('dr_name')->nullable()->default(null);
            $table->string('dr_last_name')->nullable()->default(null);
            $table->string('dr_number')->nullable()->default(null);
            $table->string('dr_email')->nullable()->default(null);

            $table->string('insurance_company')->nullable()->default(null);
            $table->string('insurance_id_number')->nullable()->default(null);
            $table->string('insurance_phone')->nullable()->default(null);
            $table->string('insurance_other_specifications')->nullable()->default(null);

            $table->string('badge_name')->nullable()->default(null);
            $table->string('badge_last_name')->nullable()->default(null);
            $table->string('badge_photo')->nullable()->default(null);
            $table->string('identity_document')->nullable()->default(null);

            // Información de asistente (Opcional)
            $table->string('attendee_name')->nullable()->default(null);
            $table->string('attendee_email')->nullable()->default(null);
            $table->boolean('send_copy_of_registration')->nullable()->default(false);
            $table->boolean('accept_terms_and_conditions')->nullable()->default(false);

            $table->string('qr')->nullable()->default(null);
            $table->longText('observation')->nullable()->default(null);
            $table->decimal('amount')->nullable()->default(3500);

            // ID del participante que invita
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

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
