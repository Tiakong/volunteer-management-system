<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestedProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interested_programmes', function (Blueprint $table) {
            $table->uuid('vid');
            $table->uuid('pid');
			$table->primary(array('vid','pid'));
			$table->foreign('vid')->references('vid')->on('volunteers');
			$table->foreign('pid')->references('pid')->on('programmes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interested_programmes');
    }
}
