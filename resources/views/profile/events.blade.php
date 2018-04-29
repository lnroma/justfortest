@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('events') }}
    @if(!$profile->notifications->count())
        <div class="container h3">
            В вашем журнале пока нет записей
        </div>
    @else
        @foreach($profile->notifications as $notify)
            @include('profile.NotifycationType.' . $notify->getAttribute('data')['type'])
        @endforeach
    @endif
@endsection