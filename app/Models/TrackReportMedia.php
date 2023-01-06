<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackReportMedia extends Model
{
    use HasFactory;
    protected $table = 'asahi_track_report_media';    
    protected $primaryKey = 'track_report_media_id';
    public $timestamps = false;
}
