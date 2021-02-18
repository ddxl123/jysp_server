<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRsTable extends Migration
{


    public function x_id_ms(Blueprint $table, string $x)
    {
        $table->bigInteger($x . "_id_m")->nullable(true);
        $table->char($x . "_id_s", 20)->nullable(true);
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rs', function (Blueprint $table) {
            $table->bigInteger("r_id_m")->autoIncrement()->unsigned()->nullable(false);
            $table->char("r_id_s", 20)->unique()->nullable(true);
            $this->x_id_ms($table, "collector");
            $this->x_id_ms($table, "fragment");
            $this->x_id_ms($table, "fragment_creator");
            $this->x_id_ms($table, "fragment_pool_node");
            $this->x_id_ms($table, "fragment_pool_node_creator");
            $this->x_id_ms($table, "memory_rule");
            $this->x_id_ms($table, "memory_rule_creator");
            $this->x_id_ms($table, "separate_rule");
            $this->x_id_ms($table, "separate_rule_creator");
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
        Schema::dropIfExists('rs');
    }
}
