<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLonelyPeptidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lonely_peptides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('job');
            $table->float('exp_mass', 16, 8);
            $table->float('rel_ion', 16, 8);
            $table->float('abs_ion', 16, 8);
            $table->string('matrix')->default('HCCA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lonely_peptides');
    }
}
