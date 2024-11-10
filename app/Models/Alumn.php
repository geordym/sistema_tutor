<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'curp',
        'collaborator_id',
    ];
}
