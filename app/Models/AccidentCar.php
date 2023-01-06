<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentCar extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_involved_car';    
    protected $primaryKey = 'involved_car_id';
    public $timestamps = false;
}
