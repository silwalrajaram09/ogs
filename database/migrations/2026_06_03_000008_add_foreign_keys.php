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
        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('user_programms', function (Blueprint $table) {
                $table->foreign('program_id')
                    ->references('id')
                    ->on('programs')->cascadeOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('user_programms', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->foreign('committee_id')
                    ->references('id')
                    ->on('committee')->cascadeOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->foreign('parent_id')
                    ->references('id')
                    ->on('committee')->nullOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('programs', function (Blueprint $table) {
                $table->foreign('parent_id')
                    ->references('id')
                    ->on('programs')->nullOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('programs', function (Blueprint $table) {
                $table->foreign('country_id')
                    ->references('id')
                    ->on('countries')->nullOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->foreign('updated_by')
                    ->references('id')
                    ->on('users')->nullOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->foreign('updated_by')
                    ->references('id')
                    ->on('users')->nullOnDelete()->cascadeOnUpdate();
            });
        } catch (\Throwable) {
            // Skip FK constraint if the driver does not support it or the table/column is unavailable
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->dropForeignIfExists('user_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->dropForeignIfExists('user_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('user_programms', function (Blueprint $table) {
                $table->dropForeignIfExists('program_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('user_programms', function (Blueprint $table) {
                $table->dropForeignIfExists('user_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->dropForeignIfExists('committee_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->dropForeignIfExists('parent_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('programs', function (Blueprint $table) {
                $table->dropForeignIfExists('parent_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('programs', function (Blueprint $table) {
                $table->dropForeignIfExists('country_id');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('user_committees', function (Blueprint $table) {
                $table->dropForeignIfExists('updated_by');
            });
        } catch (\Throwable) {}

        try {
            Schema::table('committee', function (Blueprint $table) {
                $table->dropForeignIfExists('updated_by');
            });
        } catch (\Throwable) {}
    }
};
