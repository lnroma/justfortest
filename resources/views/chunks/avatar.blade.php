<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 25.02.18
 * Time: 16:17
 */
?>

@if($user->getAvatar())
    <img
            @if(isset($class))
            class="{{$class}}"
            @else
            class="img-thumbnail"
            @endif
            height="{{$height}}px"
            width="{{$height}}px"
            src="{{ $user->getAvatar()->cdn_key }}"
            alt="{{ $user->getAvatar()->name }}">
@else
    <img src="/images/no_photo.png"
         @if(isset($class))
         class="{{$class}}"
         @else
         class="img-thumbnail"
         @endif
         height="{{$height}}px"
         width="{{$height}}px"
    />
@endif
