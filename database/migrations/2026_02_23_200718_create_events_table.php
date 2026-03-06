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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

           // $table->string('instructor');
            $table->string('status');
            $table->date('date');
            $table->string('driver');
            $table->string('car');
            $table->string('line');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('description')->nullable();

            // 👇 ADICIONE ISSO
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
