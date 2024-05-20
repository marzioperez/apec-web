<?php

use App\Concerns\Enums\PaymentMethods;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->integer('step')->nullable()->default(1);
            $table->integer('number')->nullable()->default(null);
            $table->string('voucher_type')->nullable()->default(Types::NATIONAL->value);
            $table->string('document_type')->nullable()->default(Types::INVOICE->value);

            // Datos para Factura
            $table->string('ruc')->nullable()->default(null);
            $table->string('business_name')->nullable()->default(null);

            // Datos para Boleta
            $table->string('name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('dni')->nullable()->default(null);

            // Datos para extranjero
            $table->string('client')->nullable()->default(null);
            $table->string('document_id')->nullable()->default(null);

            $table->string('physical_address')->nullable()->default(null);
            $table->string('email_address')->nullable()->default(null);
            $table->boolean('accept_policy')->nullable()->default(false);

            $table->string('payment_method')->nullable()->default(PaymentMethods::CREDIT_CARD->value);

            $table->string('payment_reference_name')->nullable()->default(null);
            $table->string('payment_reference_last_name')->nullable()->default(null);
            $table->string('payment_reference_phone')->nullable()->default(null);
            $table->string('payment_reference_email')->nullable()->default(null);
            $table->string('payment_voucher')->nullable()->default(null);

            $table->decimal('amount')->nullable()->default(0);
            $table->string('culqi_id')->nullable()->default(null);
            $table->string('status')->nullable()->default(Status::UNPAID->value);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
