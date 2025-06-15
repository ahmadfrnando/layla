<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengangkutan extends Model
{
    use HasFactory;

    protected $table = 'pengangkutan';
    protected $guarded = ['id'];
    
}
