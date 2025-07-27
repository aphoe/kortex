<?php

use App\Models\Company;
use App\Models\ResourceCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ResourceCategory::class)->nullable()->constrained()->nullOnDelete();
            $table->string('image')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('type');
            $table->boolean('is_open_source');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
