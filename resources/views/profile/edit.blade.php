<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 19.02.18
 * Time: 21:53
 */
?>

@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('profile_edit', $profile) }}
    <form method="post">
        <div class="container">
            <fieldset class="row">
                <legend>Основные настройкиы</legend>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                    {!! Form::label('name', 'Имя: ', ['class' => '  control-label col-md-4']) !!}
                    <div class="col-md-6">
                    {!! Form::text('name', $profile->getName(), ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                @foreach($attributes as $_attribute)
                    @if($_attribute->frontend_edit_type == 'textarea')
                        @include('auth.fields.textarea')
                    @elseif($_attribute->frontend_edit_type == 'select')
                        @include('auth.fields.select')
                    @else
                        @include('auth.fields.input')
                    @endif
                @endforeach

                @if(!$profile->getBirthDay()):
                <div class="form-group{{ $errors->has('birth_year') ? ' has-error' : ''}}">
                    {!! Form::label('birth_year', 'День рождения: ', ['class' => 'control-label col-md-4']) !!}
                    <div class="col-md-6">
                    {!! Form::select('birth_day', array_combine(range(1, 31),range(1, 31)), ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! Form::selectMonth('') !!}
                    {!! Form::select(
                        'birth_year',
                        array_combine(range(1940, date('Y')), range(1940, date('Y'))),
                        ['class' => 'form-control', 'required' => 'required'])
                    !!}
                    {!! $errors->first('birth_year', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                @else
                    <div class="form-group">
                        <div class="col-md-4"><b>Ваш возраст</b></div>
                        <div class="col-md-6"> {{ $profile->getOld() }} лет </div>
                    </div>
                @endif
                {!! csrf_field() !!}
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
@endsection
