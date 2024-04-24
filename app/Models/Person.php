<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    use HasFactory, CanBeScoped;

    protected $table = 'people';
    protected $fillable =['name' , 'age' , 'nationalityID', 'birthDate'];
}
