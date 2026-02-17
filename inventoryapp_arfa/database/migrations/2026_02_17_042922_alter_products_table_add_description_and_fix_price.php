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

            // Ubah price ke decimal (aman untuk data existing, int otomatis jadi xx.00)
            $table->decimal('price', 10, 2)->change();
        });

        // Drop foreign key kalau sudah ada (ignore error kalau tidak ada)
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // nama default: products_category_id_foreign
        });

        // Tambah ulang foreign key dengan constraint yang diinginkan
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade'); // atau 'restrict' / 'set null' sesuai kebutuhan
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Rollback foreign key
            $table->dropForeign(['category_id']);

            // Rollback price ke int
            $table->integer('price')->change();

            // Hapus kolom baru
            $table->dropColumn('description');
        });
    }
};