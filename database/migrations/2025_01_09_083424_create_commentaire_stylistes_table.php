<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentaireStylistesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaire_stylistes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('styliste_id')->constrained('stylistes')->onDelete('cascade');
            $table->foreignId('commentaire_id')->constrained('commentaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaire_stylistes');
    }
}
