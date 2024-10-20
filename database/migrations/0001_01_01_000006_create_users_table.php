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
            // authentication
            $table->string('uuid', 10);
            $table->char('identity_card_number', 20)->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('mobile_phone')->unique()->nullable();
            $table->boolean('is_active')->default(0); // 0 = inactive, 1 = active

            // biodata
            $table->date('birthdate')->nullable();
            $table->char('birthplace', 50)->nullable();
            $table->boolean('gender')->default(1); // 0 = female, 1 = male
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
            $table->string('photo')->nullable();
            
            // additional
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
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
