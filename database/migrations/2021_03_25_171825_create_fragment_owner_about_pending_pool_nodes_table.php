<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentOwnerAboutPendingPoolNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragment_owner_about_pending_pool_nodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id")->nullable();
            $table->unsignedBigInteger("fragment_id")->nullable();
            $table->unsignedBigInteger("pending_pool_node_id")->nullable();
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
        Schema::dropIfExists('fragment_owner_about_pending_pool_nodes');
    }
}
