<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FragmentOwnerAboutPendingPoolNode extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function belongs_to_raw_fragment()
    {
        return $this->belongsTo(RawFragment::class, "raw_fragment_aiid", "id");
    }
}
