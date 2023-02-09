<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_referentiel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->foreignId('referentiel_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_formation_referentiel');
    }
};
