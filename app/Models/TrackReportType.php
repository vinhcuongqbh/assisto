<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackReportType extends Model
{
    use HasFactory;
    protected $table = 'asahi_track_report_type';
    protected $primaryKey = 'track_type_id ';
    public $timestamps = false;
}
