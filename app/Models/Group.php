<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',
            'municipality',
            'grouptype',
            'description',
            'status',
    ];

    public function grouplinks()
    {
        return $this->hasMany(Grouplink::class, 'group_id');
    }
}
