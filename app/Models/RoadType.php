<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadType extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_road_type';    
    protected $primaryKey = 'road_type_id';
    public $timestamps = false;
}
