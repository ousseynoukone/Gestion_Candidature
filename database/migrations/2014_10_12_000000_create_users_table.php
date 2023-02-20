<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->bigInteger('role');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('age')->nullable();
            $table->string('sexe')->nullable();
            $table->string('niveauEtude')->nullable();
            $table->timestamps();
        });


        DB::table('users')->insert([
            ['prenom' => 'Admin' , 'nom' => 'Admin', 'role'=> 1 , 'email'=>'admin@gmail.com' , 'password'=>Hash::make('passer123')],
    
        ]);
    }





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
