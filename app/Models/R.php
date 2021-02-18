<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class R extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'r_id_m';
}
