<?php

namespace App\Model\User\Attribute;

use App\Model\User\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Value
 * @package App\Model\User\Attribute
 *
 * @property int $user_id
 * @property int $attribute_id
 * @property int $value
 *
 * @property Attribute $attribute
 */
class Value extends Model
{

    protected $table = 'user_attribute_value';

    public function attribute()
    {
        return $this->belongsTo(
            Attribute::class,
            'attribute_id',
            'id'
        );
    }

}
