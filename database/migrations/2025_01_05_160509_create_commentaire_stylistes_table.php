<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentaireStylistesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaire_stylistes', function (Blueprint $table) {
            $table->foreignId('id')->constrained('commentaires')->onDelete('cascade');
            $table->foreignId('styliste_id')->constrained('stylists')->onDelete('cascade');
            $table->primary(['id', 'styliste_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaire_stylistes');
    }
}
