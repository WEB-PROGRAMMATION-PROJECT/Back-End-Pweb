<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiaux extends Model
{
    use HasFactory;
    protected $table = 'materiaux'; 
    protected $fillable = ['name', 'description'];
}
