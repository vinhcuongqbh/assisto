<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMedia extends Model
{
    use HasFactory;
    protected $table = 'asahi_store_media';    
    protected $primaryKey = 'id';
    public $timestamps = false;
}
