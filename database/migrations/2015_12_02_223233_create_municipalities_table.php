<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cod');
            $table->string('name');
            
            $table->enum('subregion', [
                'rio_meta', 'la_macarena', 'area_metropolitana', 'meta_sur', 'piedemonte', 'ariari', 'otra_region'
            ])->default('otra_region');
            
            $table->timestamps();

            $table->integer('deparment_id')->unsigned();
            $table->foreign('deparment_id')->references('id')->on('deparments');

            $table->unique(['cod', 'deparment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('municipalities');
    }
}
