<?php

Route::get('/', function()
{	
	return View::make('home.index');
});

Route::post('/', function() {
	$url = Input::get('url');

	//validate url
	$validation = Url::validate(array('url' => $url));

	if( $validation !== true ) {
		return Redirect::to('/')->with_errors($validation->errors);
	}

	//if url is already in the table return that
	$record = Url::where_url($url)->first();
	if( $record ) {
		return View::make('home.result')->with('shortened', $record->shortened);
	}

	//otherwise add a new row and return the short url
	$row = Url::create(array(
			'url' => $url,
			'shortened' => Url::get_unique_short_url()
		)
	);

	//create a result view
	if( $row ) {
		return View::make('home.result')->with('shortened', $row->shortened);
	} else { 
		return View::make('home.result')->with('error', 'Woops, something went wrong');
	}
 

});

Route::get('(:any)', function($shortened){
	//query db for this result
	$row = Url::where_shortened($shortened)->first();

	//if not found redirect homepage

	if( is_null($row) ) {
		return Redirect::to('/');
	} else {
		return Redirect::to($row->url);
	}

	//otherwise fetch url and redirect
});

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

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
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