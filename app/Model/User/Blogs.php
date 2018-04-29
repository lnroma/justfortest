<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    //
    protected $table = 'user_blogs';

    public function author()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
