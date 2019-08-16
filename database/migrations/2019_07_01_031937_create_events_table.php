<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('eid')->primary();
            $table->uuid('pid');
            $table->string('name', 100);
            $table->string('description', 1000);
            $table->date('date');
            $table->string('venue', 100);
			$table->time('start_time');
			$table->time('end_time');
            $table->decimal('serve_hour',3,1);
            $table->string('created_by', 100);
            $table->string('cover_image', 255);
            $table->timestamps();
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
        Schema::dropIfExists('events');
    }
}
