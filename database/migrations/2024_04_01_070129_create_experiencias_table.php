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
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string("empresa", 60);
            $table->date("data_inicio");
            $table->date("data_termino")->nullable();
            $table->timestamps();

            $table
                ->foreignId("candidato_id")
                ->constrained()
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiecias');
    }
};
