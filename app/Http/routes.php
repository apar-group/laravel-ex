<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('register', 'RegistrationController@index');

    Route::get('register/verify/{confirmationCode}', 'RegistrationController@confirm');

    Route::get('login', function () {
        return view('login');
    });

    Route::post('login', 'Auth\AuthController@postLogin');

    Route::get('logout', function() {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/', function () {
        return view('index');
    });

    Route::get('forum', function () {
        $posts = \App\Post::orderBy('last_comment_at', 'desc')->paginate(7);
        return view('forum.index', ['posts' => $posts]);
    });

    Route::get('about', function () {
        return view('about');
    });

    Route::get('research', function () {
        return view('research');
    });

    Route::get('contact', function () {
        return view('contact');
    });

    Route::get('password/email', 'PasswordController@getEmail');

    Route::post('password/email', 'PasswordController@postEmail');

    Route::get('password/reset/{token}','PasswordController@getReset');

    Route::post('password/reset', 'PasswordController@postReset');

    Route::resource('user', 'UserController', [
        'only' => ['store', 'update']
    ]);

    Route::resource('forum/post', 'PostController', [
        'only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']
    ]);

    Route::resource('forum/comment', 'CommentController', [
        'only' => ['store', 'destroy']
    ]);

    Route::resource('news', 'NewsController', [
        'only' => ['index', 'show']
    ]);

    Route::resource('member', 'MemberController');

    Route::put('user/{id}/password', 'UserController@changePassword');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', function() {
            $user = Auth::user();
            return view('user/profile', ['user' => $user]);
        });

        Route::post('member/{id}/upload', 'MemberController@upload');

        Route::post('user/{id}/upload', 'UserController@upload');
    });

});

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function() {
    Route::get('login', function() {
        return view('admin.login');
    });

    Route::post('login', 'Auth\AuthController@postLogin');

    Route::get('logout', function() {
        Auth::logout();
        return redirect('admin/login');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', function() {
            return redirect('admin/news');
        });

        Route::resource('news', 'Admin\NewsController');

        Route::resource('user', 'Admin\UserController');

        Route::resource('forum/post', 'Admin\PostController');

        Route::resource('forum/comment', 'Admin\CommentController');

        Route::resource('member', 'Admin\MemberController');

        Route::resource('experience', 'Admin\ExperienceController');

        Route::resource('publication', 'Admin\PublicationController');

        Route::post('member/{id}/upload', 'Admin\MemberController@upload');
    });
});

