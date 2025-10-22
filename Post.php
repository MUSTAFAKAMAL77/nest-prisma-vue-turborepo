<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    protected $fillable = [
        'title', 'added_by', 'user_id', 'category_id', 'tag_id', 'address_id', 'image','video_provider', 'video_link', 
        'tags', 'description', 'audio_file', 'is_publish', 'is_approve', 'is_feature', 'is_video','is_slider','is_photo', 'is_breaking_news', 'view_count',
        'meta_title', 'meta_description', 'meta_img', 'pdf', 'slug','source','img_watermark', 'reporter_name'
    ];
    
    protected $with = ['post_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $post_translations = $this->post_translations->where('lang', $lang)->first();
        return $post_translations != null ? $post_translations->$field : $this->$field;
    }




    public function post_translations()
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

}
