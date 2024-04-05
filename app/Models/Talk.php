<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Talk extends Model
{
    use HasFactory;
    public function script():HasMany{
        return $this->hasMany(TalkMessage::class);
    }
}
