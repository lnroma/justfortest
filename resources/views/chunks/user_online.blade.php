<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.05.18
 * Time: 0:51
 */
?>
@if ($user->isOnline())
    Сейчас на сайте
@else
    @if($user->getSex() == 'male')
        Был на сайте:<br/>{{$user->updated_at}}
    @else
        Был на сайте:<br/> {{$user->updated_at}}
    @endif
@endif