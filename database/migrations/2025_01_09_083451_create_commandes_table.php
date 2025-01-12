<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('modele_id')->constrained('modeles')->onDelete('cascade');
            $table->foreignId('adresse_livraison_id')->constrained('adresse_livraisons')->onDelete('cascade');
            $table->integer('state')->default(0);
            $table->decimal('prix_total', 10, 2);
            $table->timestamp('date_commande')->useCurrent();
            $table->timestamp('date_livraison_estimee')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
