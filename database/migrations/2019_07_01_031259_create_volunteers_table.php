<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->uuid('vid')->primary();
			$table->string('id');
            $table->string('name', 100);
            $table->string('nric', 14);
            $table->string('email', 100);
            $table->string('contact_no', 16);
            $table->string('race', 50);
            $table->char('gender',1);
            $table->string('nationality', 100);
            $table->string('address', 300);
            $table->string('education_level', 100);
            $table->string('occupation');
            $table->char('t_shirt_size',2);
            $table->string('em_person', 100);
            $table->string('em_contact_no', 16);
            $table->string('em_relation', 100);
			$table->string('remark', 500);
            $table->double('acc_serve_hour');
            $table->string('profile_image',255);
			$table->date('last_active_date');
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
        Schema::dropIfExists('volunteers');
    }
}
