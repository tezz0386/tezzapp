<?php

namespace App\Models\Admin\Blog;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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
        'content',
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
