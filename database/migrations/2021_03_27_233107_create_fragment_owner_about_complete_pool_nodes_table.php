<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentOwnerAboutCompletePoolNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragment_owner_about_complete_pool_nodes', function (Blueprint $table) {
            $table->id();
            $this->foreignKeys($table);
            $table->timestamps();
        });
    }

    public function foreignKeys(Blueprint $table)
    {
        $table->unsignedBigInteger("user_id")->nullable();
        $table->unsignedBigInteger("pn_complete_pool_node_id")->nullable();
        $table->unsignedBigInteger("fragment_owner_about_pending_pool_node_id")->nullable();
        $table->unsignedBigInteger("used_rule_id")->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fragment_owner_about_complete_pool_nodes');
    }
}
