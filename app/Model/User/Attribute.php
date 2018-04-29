<?php

namespace App\Model\User;

use App\Model\User\Attribute\Value;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 * @package App\Model\User
 *
 * @property int $id
 * @property string $backend_name
 * @property string $frontend_name
 * @property string $key
 * @property string $frontend_edit_type
 * @property string $description
 * @property bool $show_in_frontend
 * @property bool $is_system
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property bool $show_in_registration
 *
 * @property Value $values
 */
class Attribute extends Model
{

    protected $table = 'user_attributes';

    public function values()
    {
        return $this->hasMany(
            Value::class,
            'attribute_id',
            'id'
        );
    }

    public function selectValues()
    {
        return $this->hasMany(
            Attribute\Select\Values::class,
            'attribute_key',
            'key'
        );
    }

}
