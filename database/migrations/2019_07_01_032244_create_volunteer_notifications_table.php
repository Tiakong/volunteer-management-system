<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_notifications', function (Blueprint $table) {
            $table->uuid('vid');
            $table->uuid('nid');
            $table->timestamp('read_at')->nullable();
			$table->primary(array('vid','nid'));
			$table->foreign('vid')->references('vid')->on('volunteers');
			$table->foreign('nid')->references('nid')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_notifications');
    }
}
