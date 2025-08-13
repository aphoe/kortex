<?php

use App\Models\ToolType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ToolType::class)->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('git_repo_url')->nullable();
            $table->boolean('is_saas');
            $table->boolean('is_self_hosted');
            $table->boolean('is_open_source');
            $table->boolean('has_api');
            $table->boolean('has_free_tier');
            $table->boolean('has_affiliate');
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->text('pricing')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
