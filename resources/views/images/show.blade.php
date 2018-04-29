<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 03.03.18
 * Time: 14:55
 */
/** @var \App\Model\User\Image\Gallery $image */
//var_dump($image->user);
?>

@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('image', $image->user, $image) }}
    {{--<div class="container">--}}
        <div class="text-center h2">
            {{$image->name}}
        </div>
        <hr/>
        <img src="{{$image->cdn_key}}">
        <hr/>
        <p>{{$image->description}}</p>
        <hr/>
        <div class="text-center">
            <a href="#"> << Предыдущее фото</a>
            |
            <a href="#">Следущее фото >> </a>
        </div>
        <hr/>
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading">{{$image->user->name}}</h4>
                <p>
                    @if($image->user->hello)
                        {{$image->user->hello}}
                    @else
                        Пользователь пока что не написал о себе
                    @endif
                </p>
            </div>
            <div class="media-right">
                @include('chunks.avatar',['user' => $image->user, 'height' => 100, 'class' => 'media-object']  )
            </div>
        </div>
        <hr/>
        <div class="h3 center-block">
            Комментарии:
        </div>
        <hr/>
        <?php if($image->comments->count() == 0): ?>
        <p>Нет комментариев будьте первым!</p>
        <?php else: ?>
        <?php
        $comments = $image
            ->comments()
            ->paginate(15, ['*'], 'page', isset($_GET['page']) ? null : ceil($image->comments->count() / 15));
        ?>
            <div class="pull-right">
                <?php echo $comments->links() ?>
            </div>
        <div class="clearfix"></div>
        <?php foreach ($comments as $_comment): ?>
        <div class="media">
            <div class="media-left">
                @include('chunks.avatar',['user' => $_comment->user, 'height' => 60, 'class' => 'media-object']  )
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$_comment->user->name}}</h4>
                <p>
                    {{ $_comment->text }}
                </p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <hr/>
        <form method="POST" class="form-horizontal">
            <div class="form-group">
                <textarea class="messages-input" name="message" id="message" placeholder="Написать"></textarea>
            </div>
            {{csrf_field()}}
            <input type="hidden" value="{{ $image->id }}" name="image_id" id="image_id"/>
            <div class="form-group">
                <button class="btn btn-success pull-right" id="send-message">Отправить</button>
            </div>
        </form>
    {{--</div>--}}
@endsection
