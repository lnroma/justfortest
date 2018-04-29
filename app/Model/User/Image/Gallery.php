<?php

namespace App\Model\User\Image;

use App\Model\User\Image\Gallery\Comment;
use App\Model\User\Image\Gallery\Directory;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'user_image_gallery';

    public function directory()
    {
        return $this->belongsTo(
            Directory::class,
            'user_image_gallery_directory_id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function comments()
    {
        return $this->hasMany(
            Comment::class,
            'user_image_gallery_id',
            'id'
        );
    }
}
