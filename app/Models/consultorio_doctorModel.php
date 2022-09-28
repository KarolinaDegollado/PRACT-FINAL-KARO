<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio_doctorModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "consultorio_doctor";
}
