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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identity_card_number', 20)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('gender', ['0', '1'])->default(1)->nullable(); // 0 = female, 1 = male
            $table->string('phone')->unique()->nullable();
            $table->text('address')->nullable();
            $table->char('province_id', 4)->nullable();
            $table->foreign('province_id')->references('code')->on('provinces')->onUpdate('cascade')->onDelete('cascade');
            $table->char('city_id', 6)->nullable();
            $table->foreign('city_id')->references('code')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->char('district_id', 8)->nullable();
            $table->foreign('district_id')->references('code')->on('districts')->onUpdate('cascade')->onDelete('cascade');
            $table->char('village_id', 11)->nullable();
            $table->foreign('village_id')->references('code')->on('villages')->onUpdate('cascade')->onDelete('cascade');
            $table->char('rt', 3)->nullable();
            $table->char('rw', 3)->nullable();
            $table->string('postcode')->nullable(); // kode pos
            $table->string('profile_image')->nullable();
            $table->enum('is_active', ['0', '1'])->default(1); // 0 = inactive, 1 = active
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password')->nullable();
            $table->foreignId('created_by')->default(1)->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
