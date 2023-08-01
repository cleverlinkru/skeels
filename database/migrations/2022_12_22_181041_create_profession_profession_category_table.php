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
        Schema::create('profession_profession_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('profession_id')->unsigned();
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');

            $table->bigInteger('profession_category_id')->unsigned();
            $table->foreign('profession_category_id')->references('id')->on('profession_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession_profession_category');
    }
};
