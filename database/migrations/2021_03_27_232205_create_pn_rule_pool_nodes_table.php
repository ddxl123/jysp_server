<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnRulePoolNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pn_rule_pool_nodes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("type")->nullable();
            $table->string("name")->nullable();
            $table->string("box_position")->nullable();
            $this->foreignKeys($table);
            $table->timestamps();
        });
    }

    public function foreignKeys(Blueprint $table)
    {
        $table->unsignedBigInteger("user_aiid")->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pn_rule_pool_nodes');
    }
}
