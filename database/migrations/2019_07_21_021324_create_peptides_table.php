<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeptidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peptides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('job');
            $table->string('parent');
            $table->float('calc_mass', 16, 8);
            $table->string('sequence');
            $table->float('rel_ion', 16, 8);
            $table->float('abs_ion', 16, 8);
            $table->string('matrix')->default('HCCA');
            // $table->integer('job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peptides');
    }
}
