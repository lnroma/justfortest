<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.02.18
 * Time: 23:52
 */
//var_dump($profile->getAvatar());die;
?>

@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('profile', $profile) }}
    {{--<div class="container" style="margin-top: 10px;">--}}
        <div class="row">
            <div class="col-md-4">
                @include('chunks.avatar',['user' => $profile, 'height' => 250])
            </div>
            <div class="col-md-8">
                <a href="/profile/edit">
                    <img class="profile__settings" src="/images/settings.png" alt="фото">
                </a>
                <h2>
                    <span id="name"> {{ $profile->getName() }} </span>
                </h2>
                <h2>
                    {{--                    {{ $profile->getCity() }}--}}
                </h2>
                <h2>
                    <?php echo $profile->getOld() ?> Лет
                </h2>
                <div class="profile__textarea">
                    @if($profile->getHello())
                        {{$profile->getHello()}}
                    @else
                        Пользователь пока ничего не написал
                    @endif
                </div>
            </div>
        </div>
        <div class="h3 center-block">Фотоальбом</div>
        <div class="panel panel-success">
            @if(!$profile->gallery->count())
            @else
                @foreach($profile->gallery as $_gallery)
                    <div class="panel-heading">
                        {{ $_gallery->filename }} - {{ $_gallery->name }}
                        @if($_gallery->directory->key != 'avatars')
                            <a href="/files/setAvatars/{{ $_gallery->id }}" class="btn btn-success">Установить
                                как аватар</a>
                        @endif
                        <a href="/files/show/{{ $_gallery->id }}" class="btn btn-success">Показать фаил</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $_gallery->cdn_key }}" class="img-responsive" alt="{{ $_gallery->name }}">

                            </div>
                            <div class="col-md-8">
                                {{ $_gallery->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#uploadFile">
            Загрузить фото
        </button>&nbsp;<br/>&nbsp;    <div class="clearfix">&nbsp;</div>


    {{--</div>--}}
        @include('modals.uploadfile')
@endsection
