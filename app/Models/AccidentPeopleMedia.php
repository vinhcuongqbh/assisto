<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentPeopleMedia extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_involved_people_insurance_media';    
    protected $primaryKey = 'insurance_media_id';
    public $timestamps = false;
}
