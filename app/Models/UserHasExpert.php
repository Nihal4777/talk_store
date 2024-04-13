<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserHasExpert extends Model
{
    use HasFactory;
    protected $table='sessions';
    public function expert():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
