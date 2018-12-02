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
Route::get('chatroom/room/create', 'RoomsController@create')->name('rooms.create');
Route::post('chatroom/room/create', 'RoomsController@store')->name('rooms.store');
Route::get('chatroom/room/{room}', 'RoomsController@show')->name('rooms.show');
Route::post('chatroom/{room}/join', 'RoomsController@join')->name('rooms.join');
Route::post('chatroom/{room}/syncuser', 'RoomsController@syncUser')->name('rooms.syncuser');
Route::post('chatroom/{room}/leave', 'RoomsController@leave')->name('rooms.leave');
Route::post('chatroom/{room}/knock', 'RoomsController@knock')->name('rooms.knock');
Route::delete('chatroom/{room}/kick/{user}', 'RoomsController@kick')->name('rooms.kick');
Route::patch('chatroom/{room}/edit', 'RoomsController@update')->name('rooms.update');
Route::delete('chatroom/{room}', 'RoomsController@destroy')->name('rooms.destroy');
Route::post('chatroom/{room}/chat/create', 'ChatsController@store')->name('chats.store');

Route::get('invite', 'InviteController@show')->name('invite.show');
Route::redirect('invite.html', 'invite', 301)->name('invite.alias');

Route::resource('notifications', 'NotificationsController', ['only' => ['index', 'show']]);

Route::get('records', 'RecordsController@index')->name('record');
