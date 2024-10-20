<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('keywords')->nullable();
            $table->longText('meta_description');
            $table->longText('description');
            $table->text('photo')->nullable();
            $table->text('photo_thumbnail')->nullable();
            $table->integer('views')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamp('published_at')->nullable()->default(now());
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tambahkan indeks full-text pada kolom 'title'
        Schema::table('articles', function (Blueprint $table) {
            $table->index('title', 'idx_fulltext_title');
        });

        // Buat indeks full-text
        DB::statement('ALTER TABLE articles ADD FULLTEXT fulltext_title_index (title)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus indeks full-text
        DB::statement('ALTER TABLE articles DROP INDEX fulltext_title_index');

        // Hapus indeks full-text pada kolom 'title'
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('idx_fulltext_title');
        });

        Schema::dropIfExists('articles');
    }
};
