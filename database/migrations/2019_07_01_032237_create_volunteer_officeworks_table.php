<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerOfficeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_officeworks', function (Blueprint $table) {
            $table->uuid('vid');
            $table->uuid('oid');
            $table->string('remark', 300);
            $table->decimal('serve_hour',3,1);
			$table->primary(array('vid','oid'));
			$table->foreign('vid')->references('vid')->on('volunteers');
			$table->foreign('oid')->references('oid')->on('officeworks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_officeworks');
    }
}
