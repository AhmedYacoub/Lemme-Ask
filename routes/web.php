<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/** 
 * Social Auth
 */
// send authorization request
Route::get('{provider}/auth', [
    'uses'  => 'SocialsController@auth',
    'as'    => 'social.auth'
]);

// receive authorization callback
Route::get('/{provider}/redirect', [
    'uses'  => 'SocialsController@auth_callback',
    'as'    => 'social.callback'
]);


Route::get('/forum', 'ForumsController@index')->name('home');


Route::resource('channels', 'ChannelsController');
Route::resource('discussions', 'DiscussionsController');
Route::post('/discussions/reply/{id}', [
    'uses'  => 'DiscussionsController@add_reply',
    'as'    => 'discussions.addReply'
]);

Route::get('/replies/like/{id}', [
    'uses'  => 'DiscussionsController@like',
    'as'    => 'replies.like'
]);

Route::get('/replies/unlike/{id}', [
    'uses'  => 'DiscussionsController@unlike',
    'as'    => 'replies.unlike'
]);


Route::get('/replies/up/{id}', [
    'uses'  => 'DiscussionsController@up',
    'as'    => 'replies.up'
]);

Route::get('/replies/down/{id}', [
    'uses'  => 'DiscussionsController@down',
    'as'    => 'replies.down'
]);

Route::get('/wachers/watch/{id}', [
    'uses'  => 'WatchersController@watch',
    'as'    => 'watchers.watch'
]);

Route::get('/watchers.unwatch/{id}', [
    'uses'  => 'WatchersController@unwatch',
    'as'    => 'watchers.unwatch'
]);

