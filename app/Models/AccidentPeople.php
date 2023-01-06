<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentPeople extends Model
{
    use HasFactory;
    protected $table = 'asahi_accident_involved_people';    
    protected $primaryKey = 'acc_involved_people_id';
    public $timestamps = false;
}
