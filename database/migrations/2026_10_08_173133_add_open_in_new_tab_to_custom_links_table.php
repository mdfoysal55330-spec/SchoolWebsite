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
        Schema::table('custom_links', function (Blueprint $table) {
            $table->boolean('open_in_new_tab')
                ->default(false)
                ->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_links', function (Blueprint $table) {
            $table->dropColumn('open_in_new_tab');
        });
    }
};
