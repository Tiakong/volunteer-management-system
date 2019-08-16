<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skillsets', function (Blueprint $table) {
            $table->uuid('vid')->primary();
			$table->tinyInteger('langEN')->default(0); //english
			$table->tinyInteger('langZH')->default(0); //chinese
			$table->tinyInteger('langMS')->default(0); //malay
			$table->tinyInteger('langHI')->default(0); //hindi
			$table->tinyInteger('mcrWord')->default(0);
			$table->tinyInteger('mcrExcel')->default(0);
			$table->tinyInteger('mcrPowerPoint')->default(0);
			$table->tinyInteger('pgrCpp')->default(0);
			$table->tinyInteger('pgrJs')->default(0);
			$table->tinyInteger('pgrPhp')->default(0);
			$table->tinyInteger('pgrSql')->default(0);
			$table->tinyInteger('pgrPython')->default(0);
			$table->tinyInteger('dsgPhotoshop')->default(0);
			$table->tinyInteger('dsgIllustrator')->default(0);
			$table->tinyInteger('dsgPremiumPro')->default(0);
			$table->tinyInteger('edgnAutocad')->default(0);
			$table->tinyInteger('edgnSolidWorks')->default(0);
			$table->boolean('dgtIT')->default(0);
			$table->boolean('dgtMultimedia')->default(0);
			$table->boolean('dgtSocialMedia')->default(0);
			$table->boolean('ctvArt')->default(0);
			$table->boolean('ctvDraw')->default(0);
			$table->boolean('ctvDance')->default(0);
			$table->boolean('ctvThretre')->default(0);
			$table->boolean('ctvMusic')->default(0);
			$table->boolean('cmmMarket')->default(0);
			$table->boolean('cmmMedia')->default(0);
			$table->boolean('cmmPresentation')->default(0);
			$table->boolean('funding')->default(0);
			$table->boolean('branding')->default(0);
			$table->boolean('business')->default(0);
			$table->boolean('entrepreneurship')->default(0);
			$table->foreign('vid')->references('vid')->on('volunteers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skillsets');
    }
}
