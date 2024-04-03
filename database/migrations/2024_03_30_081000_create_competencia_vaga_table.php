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
        Schema::create('competencia_vaga', function (Blueprint $table) {
            $table
                ->foreignId("competencia_id")
                ->constrained()
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table
                ->foreignId("vaga_id")
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
        Schema::dropIfExists('competencia_vaga');
    }
};
