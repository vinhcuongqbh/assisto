<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentMedia extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_report_media';    
    protected $primaryKey = 'acc_media_id';
    public $timestamps = false;
}
