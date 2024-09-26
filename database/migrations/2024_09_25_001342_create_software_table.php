<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('status');
            $table->unsignedInteger('licenses')->nullable(); // 4 licenses
            $table->foreignId('provider_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->datetime('purchase_date')->nullable();
            $table->datetime('expiry_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};