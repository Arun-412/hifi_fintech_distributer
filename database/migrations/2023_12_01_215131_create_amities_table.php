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
        Schema::create('amities', function (Blueprint $table) {
            $table->id();
            $table->string('amiti_code')->unique()->nullable();
            $table->string('amiti_name');
            $table->string('amiti_mode');
            $table->string('amiti_status');
            $table->string('amiti_opened_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amities');
    }
};
