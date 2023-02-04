<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    protected $casts = [
        'body' => 'array'
    ];

//pubf important :"D

    protected $appends = [
        'title_upper_case'
    ];


    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
        //$post->title_upper_case to access it!
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
