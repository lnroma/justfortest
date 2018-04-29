<?php

namespace App\Model\User\Image\Gallery;

use App\Model\User\Image\Gallery;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    //
    protected $table = 'user_image_gallery_directory';

    public function images()
    {
        return $this->hasMany(
            Gallery::class,
            'user_image_gallery_directory_id',
            'id'
        );
    }
}
