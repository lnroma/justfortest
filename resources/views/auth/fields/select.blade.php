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
    {!! Form::label($_attribute->key, $_attribute->frontend_name, ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @if(Auth::guest())
            {!! Form::select($_attribute->key, $values, null, ['class' => 'selectpicker', 'data-live-search'=>'true', 'required' => 'required']) !!}
        @else
            {!! Form::select($_attribute->key, $values, $profile->getData($_attribute->key), ['class' => 'selectpicker', 'data-live-search'=>'true', 'required' => 'required']) !!}
        @endif
        {!! $errors->first($_attribute->key, '<p class="help-block">:message</p>') !!}
    </div>
</div>

