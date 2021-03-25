<?php

namespace Custom;

use Illuminate\Database\Schema\Blueprint;

class CustomTableId
{
    // 非主键 id
    public static function x_id_no_primary(Blueprint $table, string $x)
    {
        $table->bigInteger($x)->nullable(true);
    }
}
