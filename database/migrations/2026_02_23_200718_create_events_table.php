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
            $table->string('status')->nullable();
            $table->date('date')->nullable();
            $table->string('driver')->nullable();
            $table->string('car')->nullable();
            $table->string('line')->nullable();
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
