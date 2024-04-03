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
        Schema::create('candidato_vaga', function (Blueprint $table) {
            $table
                ->foreignId("candidato_id")
                ->constrained("cascade")
                ->onUpdate("cascade")
                ->onDelete();

            $table
                ->foreignId("vaga_id")
                ->constrained()
                ->onDelete("cascade")
                ->onUpdate("delete");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato_vaga');
    }
};
