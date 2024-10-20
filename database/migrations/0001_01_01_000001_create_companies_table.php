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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('director_name');
            $table->string('short_description');
            $table->longText('description');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('gmap_link')->nullable();
            $table->text('gmap_location')->nullable();
            $table->string('tax_name');
            $table->tinyInteger('tax_value');
            $table->tinyInteger('tax_status');
            $table->integer('driver_price_daily')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_thumbnail')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
