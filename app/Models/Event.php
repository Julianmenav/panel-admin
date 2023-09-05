<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_datetime',
        'end_datetime',
        'title',
        'eventType_id'
    ];

    public function eventType() {
        return $this->belongsTo(EventType::class);
    }
}
