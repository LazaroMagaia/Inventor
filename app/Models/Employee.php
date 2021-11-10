<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $filable = [
        'name','email','address','sallery','nuit','phone','photo','join_date'
    ];
}

