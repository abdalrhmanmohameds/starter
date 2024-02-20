<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Video extends Model
{
    protected $table = 'videos';
    protected $fillable = ['name','viewers'];
    public $timestamps = false;
}
