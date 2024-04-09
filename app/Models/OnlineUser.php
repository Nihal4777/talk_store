<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineUser extends User
{
    use HasFactory;
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
} 
