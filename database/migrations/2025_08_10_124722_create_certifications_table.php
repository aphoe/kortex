<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CertificationProvider::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\CertificationType::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Currency::class)->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('validity')->nullable();
            $table->double('fee')->nullable();
            $table->string('level');
            $table->text('renewal_rules')->nullable();
            $table->string('accreditation_body')->nullable();
            $table->boolean('requires_recertification_exam');
            $table->double('renewal_fee')->nullable();
            $table->text('prerequisite')->nullable();
            $table->integer('expiry_years')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
