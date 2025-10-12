<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\PromptService::class)->nullable()->constrained()->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('prompt');
            $table->text('description')->nullable();
            $table->string('before')->nullable();
            $table->string('after')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
