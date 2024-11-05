<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'subtitle', 'content', 'image', 'date_created'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
