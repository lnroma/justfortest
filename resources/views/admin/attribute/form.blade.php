<div class="form-group{{ $errors->has('backend_name') ? ' has-error' : ''}}">
    {!! Form::label('backend_name', 'Backend name: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('backend_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('backend_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('frontend_name') ? ' has-error' : ''}}">
    {!! Form::label('frontend_name', 'Frontend name: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('frontend_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('frontend_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('key') ? ' has-error' : ''}}">
    {!! Form::label('key', 'Key: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('frontend_edit_type') ? ' has-error' : ''}}">
    {!! Form::label('frontend_edit_type', 'Frontend edit type: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('frontend_edit_type', [
            'text' => 'text',
            'select' => 'select',
            'textarea' => 'textarea',
            'multiselect' => 'multiselect'
        ], isset($attributes) ? $attributes->frontend_edit_type : 'text', ['class' => 'form-control']) !!}
        {!! $errors->first('frontend_edit_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('select_values') ? ' has-error' : ''}}">
    {!! Form::label('select_values', 'Select values: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea(
        'select_values', isset($select_value_string) ? $select_value_string : null, ['class' => 'form-control']) !!}
        {!! $errors->first('select_values', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
    {!! Form::label('description', 'Description: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('show_in_frontend') ? ' has-error' : ''}}">
    {!! Form::label('show_in_frontend', 'Show in frontend: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('show_in_frontend', ['no', 'yes'],
         isset($attributes) ? $attributes->show_in_frontend : 'no',
         ['class' => 'form-control']) !!}
        {!! $errors->first('show_in_frontend', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('show_in_anketa') ? ' has-error' : ''}}">
    {!! Form::label('show_in_anketa', 'Show in anketa: ',
    ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('show_in_anketa', ['no', 'yes'],
        isset($attributes) ? $attributes->show_in_anketa : 'no',
        ['class' => 'form-control']) !!}
        {!! $errors->first('show_in_anketa', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('filterable') ? ' has-error' : ''}}">
    {!! Form::label('filterable', 'Filterable: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('filterable', [ 'no', 'yes' ],
        isset($attributes) ? $attributes->filterable : 'no',
         ['class' => 'form-control']) !!}
        {!! $errors->first('filterable', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('show_in_filters') ? ' has-error' : ''}}">
    {!! Form::label('show_in_filters', 'Show in filters: ',
    ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('show_in_filters', ['no', 'yes'],
        isset($attributes) ? $attributes->show_in_filters : 'no',
        ['class' => 'form-control']) !!}
        {!! $errors->first('show_in_filters', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('is_system') ? ' has-error' : ''}}">
    {!! Form::label('is_system', 'Is system: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('is_system', ['no', 'yes'],
         isset($attributes) ? $attributes->is_system : 'no',
         ['class' => 'form-control']) !!}
        {!! $errors->first('is_system', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('show_in_registration') ? ' has-error' : ''}}">
    {!! Form::label('show_in_registration', 'Show in registration: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('show_in_registration', ['no', 'yes'],
        isset($attributes) ? $attributes->show_in_registration : 'no',
        ['class' => 'form-control']) !!}
        {!! $errors->first('show_in_registration', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
