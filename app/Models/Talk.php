<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talk extends Model
{
    use HasFactory,SoftDeletes;
    public function script():HasMany{
        return $this->hasMany(TalkMessage::class);
    }
}
