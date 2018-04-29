<?php

namespace App;

use App\Model\Eav;
use App\Model\User\Attribute;
use App\Model\User\Blogs;
use App\Model\User\Conversation\Conversation as ConversationTrait;
use App\Model\User\Image\Gallery;
use App\Model\User\Journal;
use App\Model\User\JournalTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * @method public addFilterAttribute($attribute, $value)
 */
class User extends Authenticatable
{
    use
        Notifiable,
        HasRoles,
        ConversationTrait,
        JournalTrait,
        Eav;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    private $isFilterInit = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function journal()
    {
        return $this->hasMany(
            Journal::class,
            'user_id',
            'id'
        );
    }

    public function gallery()
    {
        return $this->hasMany(
            Gallery::class,
            'user_id',
            'id'
        );
    }

    public function galleryDirectories()
    {
        return $this->hasMany(
            Gallery\Directory::class,
            'user_id',
            'id'
        );
    }

    public function getAvatar()
    {
        $directory = $this->galleryDirectories()->where('key', 'avatars')->first();
        if ($directory) {
            return $directory->images()->first();
        } else {
            return false;
        }
    }

    public function getOld()
    {
        $birthDay = $this->getBirthDay();
        $days = strtotime($birthDay);
        if (!$days) {
            return;
        }
        return now()->diffInYears(Carbon::createFromTimestamp($days));
    }

    public function blogs()
    {
        return $this->hasMany(
            Blogs::class,
            'user_id',
            'id'
        );
    }

    public function userAttribute()
    {
        return $this->hasMany(
            Attribute\Value::class,
            'user_id',
            'id'
        );
    }

    /**
     * @param Builder $query
     * @param $attribute
     * @param $value
     */
    protected function _initFilters($query)
    {
        if ($this->isFilterInit) {
            return $query;
        }

        $query
            ->leftJoin(
                'user_attribute_value',
                'user_attribute_value.user_id',
                '=',
                'users.id')
            ->leftJoin(
                'user_attributes',
                'user_attributes.id',
                '=',
                'user_attribute_value.attribute_id'
            );
        $this->isFilterInit = true;
        return $query;
    }

    /**
     * @param Builder $query
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function scopeAddFilterAttribute($query, $attribute, $value)
    {
        if($value == null) {
            return $query;
        }

        $subQury = Attribute\Value::query();
        $subQury
            ->select('user_id')
            ->leftJoin(
                'user_attributes',
                'user_attributes.id',
                '=',
                'user_attribute_value.attribute_id'
            )
            ->where('user_attributes.key', '=', $attribute)
            ->where('user_attribute_value.value', '=', $value)
        ;


        $query->whereIn('id', $subQury);

        return $query;
    }

}
