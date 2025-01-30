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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('tour_poitrine', 6, 2)->nullable();
            $table->decimal('tour_taille', 6, 2)->nullable();
            $table->decimal('tour_hanches', 6, 2)->nullable();
            $table->decimal('hauteur_totale', 6, 2)->nullable();
            $table->decimal('longueur_bras', 6, 2)->nullable();
            $table->decimal('tour_cou', 6, 2)->nullable();
            $table->decimal('largeur_dos', 6, 2)->nullable();  // Ajouté
            $table->decimal('longueur_jambe', 6, 2)->nullable();  // Ajouté
            $table->decimal('tour_cuisse', 6, 2)->nullable();  // Ajouté
            $table->decimal('tour_cheville', 6, 2)->nullable();  // Ajouté
            $table->decimal('tour_poignet', 6, 2)->nullable();  // Ajouté
            $table->decimal('largeur_poitrine', 6, 2)->nullable();  // Ajouté
            $table->decimal('longueur_c lavicule', 6, 2)->nullable();  // Ajouté
            $table->string('mesures_photo')->nullable();
            $table->timestamps(0);
            $table->softDeletes();;
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
        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
