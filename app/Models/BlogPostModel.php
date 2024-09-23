<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPostModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbdb_blog_posts';

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];
}
