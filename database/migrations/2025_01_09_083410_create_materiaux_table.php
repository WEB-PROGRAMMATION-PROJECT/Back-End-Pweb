<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriauxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modele_id')->constrained('modeles')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiaux');
    }
}
