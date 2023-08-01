<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->text('description');
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('attachments')->onDelete('cascade');
            $table->integer('salary');
            $table->integer('salary_up')->nullable();
            $table->integer('salary_down')->nullable();
            $table->tinyInteger('popularity')->nullable();
            $table->tinyInteger('demand')->nullable();
            $table->tinyInteger('perspective')->nullable();
            $table->tinyInteger('happy')->nullable();
            $table->boolean('demand_change')-> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professions');
    }
};
