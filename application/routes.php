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

Route::controller(Controller::detect());


Route::get('/', function()
{
	return View::make('backoffice.login');
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
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
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
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{

	// Do stuff before every request to your application...
	/*if ((time() - Session::activity()) > (Config::get('session.lifetime') * 60))
	{
	   	//return View::make('error.session_expired');
	    return Redirect::to('error/timeout');
	}
	*/
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
	if (Auth::guest()) return Redirect::to('app/login');
});

 Route::post('login',  array('https' => false,function() 
 {
    // get POST data
    $username = trim(Input::get('username'));
    $password = trim(Input::get('password'));
    
    // Reset passwords based on the new model
    /*$accts = Account::all();
    foreach($accts as $a)
    {
    	$a->password = Hash::make($a->username);
    	$a->save();
    }*/
    
    $credentials = array('username' => $username, 'password' => $password);


   if (Auth::attempt($credentials) )
     {  
         $acctid = Auth::user()->id;

         $acct = Account::find($acctid);
          
         if($acct->active)
         { 
            //save user details into session
            Session::put('acctid', $acct->id);
            Session::put('roleid', $acct->roleid);
            Session::put('roledescription', Role::find($acct->roleid)->rolename);
          
            if($acct->isnew)
            {
              return View::make('backoffice.accounts.changepassword')->with('acct',$acct);
            }
            else 
            {
                return Redirect::to('home');  
            }
        }
        else
        {
        	Log::info("ERROR: Authentication - Inactive credentials ".$credentials[0]." ".$credentials[1]);
            return Redirect::to('backoffice/app/login')
                           ->with('error_data', "Inactive credentials");
        } 
     	
           
    }
    else
    {
      Log::info("ERROR: Authentication failure - Incorrect credentials ".$credentials['username']." ".$credentials['password']);
    	
      return Redirect::to('backoffice/app/login')
                     ->with('error_data', 'Incorrect credentials '.$credentials['username']." ".$credentials['password']);
    }
    
 }));
 
 
Route::group(array('before' => 'auth'), function()
{
	Route::get('logout',  array('https' => false, function() 
	{
	    Auth::logout();
	    Session::flush();
	    return Redirect::to('backoffice/app/login');
	}));

	
	Route::get('home', function()
	{
		 return Redirect::to('backoffice/app/home');  
	});
	

});
 
 


