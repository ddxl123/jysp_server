<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnMemoryPoolNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pn_memory_pool_nodes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("type")->nullable();
            $table->string("name")->nullable();
            $table->string("position")->nullable();
            $this->foreignKeys($table);
            $table->timestamps();
        });
    }

    public function foreignKeys(Blueprint $table)
    {
        $table->unsignedBigInteger("user_id")->nullable();
        $table->unsignedBigInteger("using_raw_rule_id")->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pn_memory_pool_nodes');
    }
}