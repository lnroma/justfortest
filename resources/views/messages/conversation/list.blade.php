<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 31.01.18
 * Time: 22:46
 */
?>
@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('conversation') }}
    <section class="opoveshenia">
        <div class="opoveshenia-container">
            @if($conversations->count() == 0)
                <p>У вас пока нет сообщений, что бы найти собеседника воспользуйтесь  <a href="/home">поиском</a> </p>
            @else
                @foreach($conversations as $_conversation)
                    @if(!$_conversation->getLastMessage())
                        @continue
                    @endif
                    <div class="opoveshenia-item"
                        @if($_conversation->getLastMessage()->user_from != Auth::user()->id
                        && !$_conversation->getLastMessage()->is_read)
                            style="background-color:#c8eac8;"
                            @endif
                    >
                        <div>
                            @include('chunks.avatar',['user' => $_conversation->getInterlocutor(), 'height' => 100])
                        </div>
                        <div class="opoveshenia-item__txt">
                            <h6>
                                {{$_conversation->getInterlocutor()->name}}
                            </h6>
                            <p class="opoveshenia-item__comment">
                                {{$_conversation->getLastMessage()->message}}
                            </p>
                        </div>
                        <div class="opoveshenia-item__datetime">
                            {{$_conversation->getLastMessage()->created_at}}
                        </div>
                        <a class="opoveshenia-item__answer" href="/messages/{{$_conversation->getInterlocutor()->id}}">Читать</a>
                    </div>
            @endforeach
        @endif
        <!-- content -->
        </div>
    </section>

@endsection
