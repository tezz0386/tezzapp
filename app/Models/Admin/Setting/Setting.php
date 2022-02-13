<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'p_email',
        's_email',
        't_no',
        'm_no',
        'logo',
        'location',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
        'google_link',
        'whatsapp_no',
        'viber_no',
        'title_tag',
        'meta_keywords',
        'meta_description',
    ];
}
