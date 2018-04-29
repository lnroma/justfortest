<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 03.02.18
 * Time: 21:07
 */
?>
<div class="form-group{{ $errors->has($_attribute->key) ? ' has-error' : ''}}">
    {!! Form::label($_attribute->key, $_attribute->frontend_name, ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($_attribute->key, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first($_attribute->key, '<p class="help-block">:message</p>') !!}
    </div>
</div>

