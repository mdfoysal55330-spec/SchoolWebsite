<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // image, pdf অথবা link
            $table->string('type');

            // Uploaded file অথবা external URL
            $table->string('file_path')->nullable();
            $table->text('external_url')->nullable();

            $table->date('publish_date')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};