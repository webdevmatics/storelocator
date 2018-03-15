<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('zip',20)->nullable();
            $table->float('lat',10,6)->nullable();
            $table->float('lng',10,6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
