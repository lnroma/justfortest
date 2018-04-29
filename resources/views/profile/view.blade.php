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
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-4">
                @include('chunks.avatar',['user' => $profile, 'height' => 250])
            </div>
            <div class="col-md-8">
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
        <div class="row pull-right center-block">
            <div class="col">
                <a href="/messages/{{$profile->id}}" class="btn btn-success"><span
                            class="glyphicon glyphicon-envelope"></span> Написать</a><br/>
            </div>
        </div>
        <div class="h3 center-block">Фотоальбом</div>
        <div class="col">
            @if(!$profile->gallery->count())
            @else
                @foreach($profile->gallery as $_gallery)
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="/files/show/{{ $_gallery->id }}">
                                <img src="{{ $_gallery->cdn_key }}" class="img-responsive" alt="{{ $_gallery->name }}">
                                <div class="caption">
                                    <h4>{{ $_gallery->filename }} - {{ $_gallery->name }}</h4>
                                    <p>
                                        {{ $_gallery->description }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="clearfix"></div>

        <div class="clearfix"></div>

        <div class="h3 center-block">Немного о себе:</div>
        <?php if(!$profile->getAboutMe()): ?>
        <p>Пользователь пока не написал ничего о себе</p>
        <?php else: ?>
        <p><?php echo $profile->getAboutMe() ?></p>
        <?php endif;?>
        <div class="clearfix"></div>
    </div>
@endsection
