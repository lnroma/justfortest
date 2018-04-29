<?php

// search
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Поиск', route('home'));
});
// profile
Breadcrumbs::register('profile', function ($breadcrumbs, $profile) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($profile->getName(), '/profile/' . $profile->id);
});

Breadcrumbs::register('events', function ($breadcrumbs){
   $breadcrumbs->parent('home');
   $breadcrumbs->push('Уведомления', '/events/');
});
// edit profile
Breadcrumbs::register('profile_edit', function ($breadcrumbs, $profile) {
    $breadcrumbs->parent('profile', $profile);
    $breadcrumbs->push('Редактирование профиля', '/profile/edit');
});
// message
Breadcrumbs::register('message', function ($breadcrumbs, $profile) {
    $breadcrumbs->parent('profile', $profile);
    $breadcrumbs->push('Список сообщений', '/messages/list');
    $breadcrumbs->push('Диалоги', '/messages/' . $profile->id);
});
// image breadcrumbs
Breadcrumbs::register('image', function ($breadcrumbes, $profile, $image) {
    $breadcrumbes->parent('profile', $profile);
    $breadcrumbes->push($image->name, '/fales/show/' . $image->id);
});
// conversation
Breadcrumbs::register('conversation', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Список сообщений', '/messages/list');
});