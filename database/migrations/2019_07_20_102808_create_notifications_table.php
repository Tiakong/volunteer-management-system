<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('nid')->primary();
			$table->string('title', 100);
			$table->string('description', 1000);
			$table->string('category', 100);
			$table->boolean('for_volunteer')->default(1);
			$table->boolean('for_admin')->default(1);
			$table->boolean('broadcast')->default(0);
			$table->boolean('is_auto')->default(0);
			$table->string('created_by', 100);
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
        Schema::dropIfExists('notifications');
    }
}
