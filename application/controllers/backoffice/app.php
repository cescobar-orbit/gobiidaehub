<?php

class Backoffice_App_Controller extends Base_Controller {

   public $layout = 'layouts.container';

	 
   public function action_login($lang="")
	{
		
		$lang = ($lang == "" || !isset($lang)) ? "en" : $lang;
		
		Session::put('lang', $lang);
        return View::make('backoffice.login');
	}
	
	
	public function action_logout()
	{
		return View::make('backoffice.login');
	}
	
	public function action_home()
	{
		return View::make('backoffice.home');
	}
	
	public function action_redirect($path)
	{
		return Redirect::to("home");
	}
   
	
}