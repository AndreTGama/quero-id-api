<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->longText('description')->nullable();
            $table->string('city', 125)->nullable();
            $table->string('state', 125)->nullable();
            $table->string('country', 125)->nullable();
            $table->string('continent', 125)->nullable();
            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 10, 8)->nullable();
            $table->string('currecy', 125)->nullable();
            $table->string('monetary_unit', 12)->nullable();
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
        Schema::dropIfExists('places');
    }
}
