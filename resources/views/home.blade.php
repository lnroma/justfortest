@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('home') }}
    <div class="alert alert-warning padding-top">
        <form method="get" class="form-inline center-block" action="{{ route('home') }}">
            @include('search.search_form')
        </form>
    </div>
    <section class="search"></section>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h1>Результаты поиска</h1>
    <div class="row">
        @foreach ($users as $_user)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail " style="min-height: 600px">
                    @include('chunks.avatar',['user' => $_user, 'height' => 350])
                    <div class="caption">
                        <h3>{{$_user->name}}</h3>
                        <p> {{$_user->getCity()}}</p>
                        <p>{{$_user->getOld()}} Лет</p>
                        <p>
                            @include('chunks.user_online',['user' => $_user])
                        </p>
                        <p><a href="/messages/{{$_user->id}}" class="btn btn-success" role="button">Написать</a>
                            <a href="/profile/{{$_user->id}}" class="btn btn-default" role="button">Продробнее</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$users->render()}}

@endsection
