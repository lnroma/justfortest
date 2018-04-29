<?php

namespace App\Model\User\Image\Gallery;

use App\Model\User\Image\Gallery;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'user_image_gallery_comment';

    public function gallery()
    {
        return $this->belongsTo(
            Gallery::class,
            'user_image_gallery_id',
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
}
