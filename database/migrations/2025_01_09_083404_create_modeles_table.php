<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modeles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('styliste_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('story')->nullable();
            $table->text('materiaux_ids')->nullable();
            $table->integer('points')->default(0);
            $table->enum('status', ['available', 'unavailable', 'archived'])->default('available');
            $table->decimal('prix_min', 10, 2);
            $table->decimal('prix_max', 10, 2);
            $table->string('devise')->default('XAF');
            $table->integer('temps_min');
            $table->integer('temps_max');
            $table->string('unite_temps')->default('jours');
            $table->string('styles')->nullable();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
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
        Schema::dropIfExists('modeles');
    }
}
