<?php

namespace App\Models;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasLinks;
    use HasFactory;

    protected $fillable = [
        'name',
        'municipality',
        'geolocation',
        'description',
        'status',
    ];
}
