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
        Schema::create('user_committees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('order_no', 8, 2)->default(0.0);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('committee_id');
            $table->timestamps();

            $table->unique(['user_id', 'committee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_committees');
    }
};
