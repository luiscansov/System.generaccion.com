<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_usuario', function (Blueprint $table) {
            $table->increments('i_usuario_id');
            $table->string('v_nombres', 45);
            $table->string('v_apellidos', 45);
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('adm_rol', function (Blueprint $table) {
            $table->increments('i_rol_id');
            $table->string('v_nombre', 45);
            $table->char('c_estado', 1)->default('0');
            $table->timestamps();
        });

        Schema::create('adm_area', function (Blueprint $table) {
            $table->increments('i_area_id');
            $table->string('v_nombre', 45);
            $table->string('v_url', 191)->unique();
            $table->integer('i_areapadre_id')->unsigned()->nullable()->default(null);
            $table->char('c_estado', 1)->default('0');
            $table->timestamps();
            $table->foreign('i_areapadre_id')->references('i_area_id')->on('adm_area');
        });

        Schema::create('adm_rol_area', function (Blueprint $table) {
            $table->increments('i_rolarea_id');
            $table->integer('i_rol_id')->unsigned();
            $table->integer('i_area_id')->unsigned();
            $table->char('c_estado', 1)->default('0');
            $table->timestamps();
            $table->foreign('i_rol_id')->references('i_rol_id')->on('adm_rol');
            $table->foreign('i_area_id')->references('i_area_id')->on('adm_area');
        });

        Schema::create('adm_usuario_rol', function (Blueprint $table) {
            $table->increments('i_usuariorol_id');
            $table->integer('i_usuario_id')->unsigned();
            $table->integer('i_rol_id')->unsigned();
            $table->char('c_estado', 1)->default('0');
            $table->timestamps();
            $table->foreign('i_usuario_id')->references('i_usuario_id')->on('adm_usuario');
            $table->foreign('i_rol_id')->references('i_rol_id')->on('adm_rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_usuario_rol');
        Schema::dropIfExists('adm_rol_area');
        Schema::dropIfExists('adm_area');
        Schema::dropIfExists('adm_rol');
    }
}