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
        Schema::create('peripherals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('serial_number')->nullable();
            $table->string('type'); // Mouse|Keyboard|Monitor|Headset|Printer|Scanner|Webcam
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
        Schema::dropIfExists('peripherals');
    }
};