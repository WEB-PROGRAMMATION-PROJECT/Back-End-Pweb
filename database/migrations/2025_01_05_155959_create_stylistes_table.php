<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylistes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points')->default(0);
            $table->string('role', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->integer('experience')->nullable();
            $table->integer('collections')->default(0);
            $table->integer('awards')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->text('bio')->nullable();
            $table->string('photo_profil', 255)->nullable();
            $table->string('response_time', 50)->nullable();
            $table->integer('completed_orders')->default(0);

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stylistes');
    }
}
