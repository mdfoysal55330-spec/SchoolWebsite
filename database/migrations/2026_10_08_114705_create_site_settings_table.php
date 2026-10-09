<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('school_name')->nullable();
            $table->string('logo')->nullable();

            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('principal_name')->nullable();
            $table->string('principal_photo')->nullable();
            $table->text('principal_message')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->string('favicon')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};