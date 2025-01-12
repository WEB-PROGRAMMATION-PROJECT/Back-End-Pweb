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
            $table->foreignId('styliste_id')->constrained('stylists')->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->text('story')->nullable();
            $table->integer('points')->default(0);
            $table->enum('status', ['available', 'unavailable', 'archived'])->default('available');
            $table->decimal('prix_min', 10, 2);
            $table->decimal('prix_max', 10, 2);
            $table->string('devise', 10)->default('XAF');
            $table->integer('temps_min');
            $table->integer('temps_max');
            $table->string('unite_temps', 20)->default('jours');
            $table->string('styles', 255)->nullable();
            $table->string('image1', 255);
            $table->string('image2', 255);
            $table->string('image3', 255);
            $table->string('image4', 255)->nullable();
            $table->string('image5', 255)->nullable();
            $table->timestamps();
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
