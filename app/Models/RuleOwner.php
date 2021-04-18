<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleOwner extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function belongs_to_raw_rule()
    {
        return $this->belongsTo(RawRule::class, "raw_rule_id", "id");
    }
}
