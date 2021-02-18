<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeparateRule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'separate_rule_id_m';
}
