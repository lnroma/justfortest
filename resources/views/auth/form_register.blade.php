<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Password: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
    {!! Form::label('password_confirmation', 'Password confirm: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('birth_year') ? ' has-error' : ''}}">
    {!! Form::label('birth_year', 'Birth day: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('birth_day', array_combine(range(1, 31),range(1, 31)), ['class' => 'form-control', 'required' => 'required']) !!}
        {!! Form::select('birth_month', array_combine(range(1, 12), range(1,12)), ['class' => 'form-control', 'required' => 'required']) !!}
        {!! Form::select('birth_year', array_combine(range(1940, date('Y')), range(1940, date('Y'))), ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('birth_year', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@foreach($user_attribute as $_attribute)
    @if($_attribute->frontend_edit_type == 'textarea')
        @include('auth.fields.textarea')
    @elseif($_attribute->frontend_edit_type == 'select')
        @include('auth.fields.select')
    @else
        @include('auth.fields.input')
    @endif
@endforeach
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
