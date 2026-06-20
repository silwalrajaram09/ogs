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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->enum('type', ['travel', 'anniversary'])->default('travel');
            $table->longText('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('no_of_days');
            $table->string('location', 255);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
