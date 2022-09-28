<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametrospModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "parametros_paciente";
}
