<?php

namespace App\Models\Admin\Skill;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'precentage',
        'status',
        'content',
    ];
}
