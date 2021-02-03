<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use database\migrations\BaseMigration\Xidms;

class CreateFragmentPoolNodesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragment_pool_nodes', function (Blueprint $table) {
            $table->bigInteger("fragment_pool_node_id_m")->autoIncrement()->unsigned()->nullable(false);
            $table->char("fragment_pool_node_id_s", 20)->unique()->nullable();
            $table->tinyInteger("pool_type")->unsigned()->nullable(false);
            $table->integer("node_type")->unsigned()->nullable(false);
            $table->string("route", 50)->nullable(false);
            $table->string("name", 20);
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
        Schema::dropIfExists('fragment_pool_nodes');
    }
}
