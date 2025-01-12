<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adresse_livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('pays', 100);
            $table->string('ville', 100);
            $table->string('rue', 255)->nullable();
            $table->string('quartier', 100)->nullable();
            $table->enum('type', ['domicile', 'bureau', 'autre'])->default('domicile');
            $table->boolean('est_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresse_livraisons');
    }
}
