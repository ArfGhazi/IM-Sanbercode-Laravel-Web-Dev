<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambah description kalau belum ada
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('image');
            }

            // Pastikan price decimal (kalau masih int, ubah)
            if (Schema::getColumnType('products', 'price') !== 'decimal') {
                $table->decimal('price', 12, 2)->change();
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            // Tambah description kalau belum ada
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });

        // Optional: tambah soft deletes kalau model pakai SoftDeletes
        if (!Schema::hasColumn('products', 'deleted_at')) {
            Schema::table('products', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('categories', 'deleted_at')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description', 'deleted_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'deleted_at']);
        });
    }
};