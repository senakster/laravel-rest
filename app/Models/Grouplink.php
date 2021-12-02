<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grouplink extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'url',
        'description',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
