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
        Schema::create('account_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('certificate_token', 64)->unique();
            $table->string('statement_token', 64)->unique();
            $table->string('account_no', 50)->unique();
            $table->string('account_name', 255);
            $table->string('account_type', 100)->nullable();
            $table->string('certificate_id', 50)->nullable();
            $table->date('account_open_date')->nullable();
            $table->string('certificate_balance', 50)->default('0.00');
            $table->string('opening_balance', 50)->default('0.00');
            $table->string('closing_balance', 50)->default('0.00');
            $table->date('statement_period_from')->nullable();
            $table->date('statement_period_to')->nullable();
            $table->dateTime('statement_generated_at')->nullable();
            $table->date('report_generation_date')->nullable(); // Solvency issue date
            $table->string('currency', 10)->nullable();
            $table->string('equivalent_balance', 50)->nullable();
            $table->string('bank_name', 255)->default('Pubali Bank PLC.');
            $table->string('branch_name', 255)->nullable();
            $table->string('status', 20)->default('valid'); // valid, revoked, expired
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_verifications');
    }
};
