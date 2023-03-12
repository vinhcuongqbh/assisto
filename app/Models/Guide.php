<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    protected $table = 'asahi_guide_file';    
    protected $primaryKey = 'guide_file_id';
    public $timestamps = false;
}
