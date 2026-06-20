<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('full_name', 255);
            $table->string('email', 255)->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('password', 255);
            $table->string('slug', 255)->unique();
            $table->string('designation', 255)->nullable();
            $table->string('address', 255);
            $table->string('profile_description', 255)->nullable();
            $table->string('fb_link', 255);
            $table->string('youtube_link', 255);
            $table->string('tiktok_link', 255);
            $table->string('photo_path', 255);
            $table->enum('type', ['admin', 'user'])->default('user');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('member_type', ['yearly', 'lifetime'])->default('yearly');
            $table->boolean('is_active')->default(true);
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
