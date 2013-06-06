<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

//RESTFUL LESSONS ROUTES
// Route::get('about', 'home@about');

// // Route::controller('home');
// // Route::controller('users');
// //or Route::controller(array('home', 'users'));

// Route::get('users/(:any)/edit', 'users@edit');


//NAMED CONTROLLERS
// Route::get('movies', array('as'=>'movies', 'uses'=>'movies@index'));
// Route::get('movies/(:any)', array('as'=>'movie', 'uses'=>'movies@show'));
// Route::get('movies/new', array('as'=>'new_movie', 'uses'=>'movies@new'));

// Route::controller(Controller::detect());


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

//AUTH LESSONS
// Route::get('/', function(){
// 	$credentials = array(
// 		'username' => 'pimmeijer@outlook.com',
// 		'password' => 'test'
// 	);

// 	if( Auth::attempt($credentials) )
// 	{
// 		if( Auth::check() )
// 		{
// 			return 'User is already logged in!';
// 		}

// 		return 'User acknowledged';
// 	}
// 	return 'No accoutn for you';
// });

// Route::get('/logout', function(){
// 	Auth::logout();
// 	return 'logged out';
// });

// Route::get('/admin', array('before'=>'auth', function() {
// 	$user = Auth::user();
// 	return 'Private adimn section ' . $user->name;
// 	})
// );

// Route::get('/login', function(){
// 	return 'Login Form';
// });

//ELOQUENT 201

Route::get('/authors/(:num)/posts', function($id){
	// Author::find(1)->posts()->insert(array(
	// 	'title' => 'My second post',
	// 	'body' => 'The body of my first poost'
	// ));

	// var_dump(Post::find(1)->author);

	// Author::find(1)->posts()->insert(array(
	// 	'title' => 'Post',
	// 	'body' => 'Body of post'
	// 	)
	// );

	// Author::find(1)->posts()->insert(array(
	// 	'title' => 'Post 2',
	// 	'body' => 'Body of post'
	// 	)
	// );
	$posts = Author::find($id)->posts()->get();
	
	//eager loading!
	$posts = Post::with('author')->where('author_id', '=', $id)->get();
	return View::make('post.index')->with('posts', $posts);
});

Event::listen('laravel.query', function($sql){
	var_dump($sql);
});

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});
 /* |-------------------------------------------------------------------------- | Route Filters |-------------------------------------------------------------------------- | | Filters provide a convenient method for attaching functionality to your | routes. The built-in before and after filters are called before and | after every request to your application, and you may even create | other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});