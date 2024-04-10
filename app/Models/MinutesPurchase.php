<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinutesPurchase extends Model
{
    use HasFactory;
    protected $table='minute_purchases';
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
