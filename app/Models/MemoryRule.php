<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryRule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'memory_rule_id_m';
}
