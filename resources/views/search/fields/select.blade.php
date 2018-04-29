<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 03.02.18
 * Time: 21:07
 */

$values = [];

foreach ($_attribute->selectValues as $_values) {
    $values[$_values->key] = $_values->value;
}

?>

<div class="form-group{{ $errors->has($_attribute->key) ? ' has-error' : ''}}">
    {!! Form::label($_attribute->key, $_attribute->frontend_name, ['class' => 'sr-only']) !!}
    {{--<div class="col-md-6">--}}
        {!! Form::select($_attribute->key, $values, 'Москва', ['class' => 'selectpicker', 'data-live-search'=>'true', 'required' => 'required']) !!}
        {!! $errors->first($_attribute->key, '<p class="help-block">:message</p>') !!}
    {{--</div>--}}
</div>

