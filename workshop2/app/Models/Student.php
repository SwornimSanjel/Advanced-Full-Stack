<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends Model
{
    // mass assignment
    protected $fillable = ["name", "email", "phone", "address", "date_of_birth"];

    protected $casts = [
        "date_of_birth" => "date"
    ];

    function age(): Attribute
    {
        return Attribute::make(
            fn() => $this->date_of_birth->age
        );
    }
}
