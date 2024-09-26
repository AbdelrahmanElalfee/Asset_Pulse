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
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('serial_number');
            $table->string('operating_system')->nullable();
            $table->string('operating_system_version')->nullable();
            $table->string('type');
            $table->string('cpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('status');
            $table->foreignId('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('provider_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->datetime('purchase_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware');
    }
};