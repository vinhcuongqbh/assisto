<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
    protected $table = 'asahi_track_report';    
    protected $primaryKey = 'track_id';
    public $timestamps = false;
}
