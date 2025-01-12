<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('modele_id')->constrained('modeles');
            $table->foreignId('adresse_livraison_id')->constrained('adresse_livraisons');
            $table->integer('state')->default(0);
            $table->decimal('prix_total', 10, 2);
            $table->timestamp('date_commande')->useCurrent();
            $table->date('date_livraison_estimee')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
}
