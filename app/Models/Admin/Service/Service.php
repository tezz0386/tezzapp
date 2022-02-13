<?php

namespace App\Models\Admin\Service;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
        'order',
        'title',
        'icon',
        'status',
        'slug',
        'summary',
        'description',
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
