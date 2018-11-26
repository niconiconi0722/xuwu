<?php

Route::get('/', 'IndexController@index')->name('index');
Route::post('/', 'IndexController@auth')->name('index.auth');

Route::resource('users', 'UsersController', ['except' => [
    'show', 'create'
]]);
Route::get('sign_up', 'UsersController@create')->name('users.create');
Route::put('users/{user}', 'AuthoritiesController@update')->name('users.authority');

Route::get('log_in', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('log_in', 'Auth\LoginController@login')->name('login');
Route::delete('log_out', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('announcements', 'AnnouncementsController');

Route::resource('articles', 'ArticlesController', ['only' => [
    'index', 'show', 'create', 'store', 'destroy'
]]);

Route::resource('articles.replies', 'RepliesController', ['only' => ['create', 'store', 'show', 'destroy']]);

Route::get('chatroom/lounge', 'RoomsController@index')->name('rooms.index');
Route::get('chatroom/room/{room}', 'RoomsController@show')->name('rooms.show');
Route::post('chatroom/join/{room}', 'RoomsController@join')->name('rooms.join');
Route::post('chatroom/leave/{room}', 'RoomsController@leave')->name('rooms.leave');
Route::post('chatroom/chat/create', 'ChatsController@store')->name('chats.store');

Route::get('invite', 'InviteController@show')->name('invite.show');
Route::redirect('invite.html', 'invite', 301)->name('invite.alias');

Route::resource('notifications', 'NotificationsController', ['only' => ['index', 'show']]);

Route::get('records', 'RecordsController@index')->name('record');
