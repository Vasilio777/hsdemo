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
        Schema::create('earth_eons', function (Blueprint $table) {
            $table->id();
            $table->string('eon');
            $table->string('era');
            $table->string('period');
            $table->string('subperiod')->nullable();
            $table->string('epoch');
            $table->string('age');
            $table->double('base');
            $table->double('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earth_eons');
    }
};
