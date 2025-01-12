<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->decimal('tour_poitrine', 6, 2)->nullable();
            $table->decimal('tour_taille', 6, 2)->nullable();
            $table->decimal('tour_hanches', 6, 2)->nullable();
            $table->decimal('hauteur_totale', 6, 2)->nullable();
            $table->decimal('longueur_bras', 6, 2)->nullable();
            $table->decimal('tour_cou', 6, 2)->nullable();
            $table->string('mesures_photo', 255)->nullable();

            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
