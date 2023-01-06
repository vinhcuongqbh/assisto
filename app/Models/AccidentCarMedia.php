<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentCarMedia extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_involved_car_media';    
    protected $primaryKey = 'car_media_id';
    public $timestamps = false;
}
