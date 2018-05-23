@component('mail::message')
    @component('mail::panel')
        Привет {{$user->name}}! У тебя есть новое сообщение!
    @endcomponent
    Прочитай его в своем личном кабинете
    @component('mail::button', ['url' => 'http://pisec.online', 'color' => 'green'])
        Личном кабинете
    @endcomponent
@endcomponent
