@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('message', $conversation->getInterlocutor()) }}
    {{--<section class="container">--}}
    <div id="messages">
        @section('message')
            @if($conversation->messages->count() == 0)
                Напиши сообщение
            @else
                <?php
                $messages = $conversation
                    ->messages(49336)
                    ->paginate(15, ['*'], 'page', isset($_GET['page']) ? null : ceil($conversation->messages->count() / 15))
                    ->setPath('/messages/' . $conversation->getInterlocutor($authUser)->id .
                        (isset($_GET['page_conversation']) ? '?page_conversation=' . $_GET['page_conversation'] : '')
                    );
                echo $messages->links()
                ?>

                @foreach($messages as $_message)
                    <div class="msg
                        @if($_message->user_from == $authUser->id)
                            msg-me
@else
                            msg-who
<?php $_message->is_read = 1; $_message->save() ?>
                    @endif
                            ">
                        <div class="blockquote">
                            <div>
                                <small class="text-secondary">
                                    @if(!$_message ->is_read)
                                        <span class="glyphicon glyphicon-envelope"></span>
                                    @endif
                                    @if($_message->user_from == $authUser->id)
                                        {{$authUser->getName()}}
                                        @if($authUser->isOnline())
                                            Сейчас на сайте
                                        @else
                                            Отошел
                                        @endif
                                    @else
                                        {{$conversation->getInterlocutor($authUser)->getName()}}
                                        @if($conversation->getInterlocutor($authUser)->isOnline())
                                            Сейчас на сайте
                                        @else
                                            Отошел
                                        @endif
                                    @endif
                                </small>
                                <hr/>
                                {{$_message->message}}
                                <hr/>
                                <small class="text-secondary">
                                    {{$_message->created_at}}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @show
    </div>
    {{--<h3 class="msg-
    date">Today - 19:44</h3>--}}
    <form method="POST" class="form-horizontal">
        <textarea class="messages-input" name="message" id="message" placeholder="Написать"></textarea>
        {{csrf_field()}}
        <input type="hidden" value="{{ $conversation->id }}" name="conversation_id" id="conversation_id"/>
            <button class="btn btn-success pull-right" id="send-message">Отправить</button>
    </form>
    &nbsp;<br/>
    <div class="clearfix"></div>
    {{--</section>--}}
@endsection
