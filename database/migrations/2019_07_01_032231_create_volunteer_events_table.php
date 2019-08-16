<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_events', function (Blueprint $table) {
			$table->uuid('vid');
            $table->uuid('eid');
            $table->char('status');
            $table->string('remark', 300);
            $table->decimal('serve_hour',3,1);
			$table->primary(array('vid','eid'));
			$table->foreign('vid')->references('vid')->on('volunteers');
			$table->foreign('eid')->references('eid')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_events');
    }
}
