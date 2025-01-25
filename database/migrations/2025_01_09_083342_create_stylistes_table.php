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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->text('specializations')->nullable();
            $table->text('titre')->nullable();
            $table->text('description')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->integer('points')->default(0);
            $table->integer('collections')->default(0);
            $table->integer('awards')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->string('response_time')->nullable();
            $table->integer('completed_orders')->default(0);
            $table->text('social_links')->nullable();
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
        Schema::dropIfExists('stylistes');
    }
}
