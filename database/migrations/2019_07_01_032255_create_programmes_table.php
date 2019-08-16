<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->uuid('pid')->primary();
            $table->string('code', 6);
            $table->string('name', 100);
            $table->string('description', 1000);
            $table->string('target', 100);
            $table->string('contact', 14);
            $table->int('start_month',2);
            $table->int('end_month',4);
            $table->string('start_year',2);
            $table->string('end_year',4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmes');
    }
}
