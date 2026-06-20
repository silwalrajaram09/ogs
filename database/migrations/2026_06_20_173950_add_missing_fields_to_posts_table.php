<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('posts', 'type')) {
                $table->enum('type', ['announcement', 'news', 'blog'])->default('announcement');
            }

            if (!Schema::hasColumn('posts', 'author_id')) {
                $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            }

            if (!Schema::hasColumn('posts', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
            if (!Schema::hasColumn('posts', 'default_photo')) {
                $table->string('default_photo', 255)->nullable();
            }

            // Rename 'description' to 'body' if you prefer 'body'
            // Option 1: Keep as 'description' and update controller
            // Option 2: Rename to 'body'
            // I recommend Option 1 (keep as 'description') - no changes needed
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['type', 'author_id', 'published_at']);
        });
    }
};