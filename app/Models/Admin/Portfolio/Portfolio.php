<?php

namespace App\Models\Admin\Portfolio;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
        'order',
        'title',
        'image',
        'status',
        'slug',
        'summary',
        'description',
        'url',
        'type',
        'is_developed',
        'title_tag',
        'meta_keywords',
        'meta_description',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
