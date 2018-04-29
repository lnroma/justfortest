@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('home') }}
    <div class="alert-info alert" role="alert">
        Выберите в поиске пол и город в котором хотели бы найти знакомства,
        далее посмотрите на подходящего человека, и напишите ему
    </div>
    <section class="search">
        <div class="search-container">
            <form  method="get" class="form-inline center-block" action="{{ route('home') }}">
                @include('search.search_form')
            </form>
        </div>
    </section>
    <section class="search"></section>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <section class="contacts">
        <div class="contacts-container">
            <h1>Результаты поиска</h1>
            <div class="contacts-list">
                @foreach ($users as $_user)
                    <div class="contacts-item">
                        <div class="contacts-item__collumn contacts-item__collumn1">
                            @include('chunks.avatar',['user' => $_user, 'height' => 200])
                            <a href="/messages/{{$_user->id}}" class="btn btn-success">Написать</a><br/>
                        </div>
                        <div class="contacts-item__collumn contacts-item__collumn2">
                            <h2><a href="/profile/{{$_user->id}}">{{$_user->name}}</a></h2>
                            <?php if ($_user->getOld()): ?>
                            <h2>{{$_user->getOld()}} лет</h2>
                            <?php else: ?>
                            <h2>Возраст не известен</h2>
                            <?php endif;?>
                            <?php if($_user->getCity()): ?>
                            <h2>{{ $_user->getCity() }}</h2>
                                <?php else:?>
                                <h2>Город не указан</h2>
                            <?php endif;?>
                            <?php if($_user->getHello()): ?>
                            <p>{{ $_user->getHello() }}</p>
                            <?php else: ?>
                            <p>Пользователь пока не придумал приветствее</p>
                            <?php endif; ?>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$users->render()}}
        </div>
    </section>

@endsection
