@extends('layouts.app')

@section('content')
    <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">Регистрация нового пользователя</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            @include('auth/form_register')
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
