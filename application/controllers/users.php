<?php  
class Users_Controller extends Base_Controller {
	public $restful = true;

	public function get_index() 
	{
		return View::make('users.index');
	}

	public function post_index()
	{
		return 'Form was posted the name was ' . Input::get('name');
	}
}
?>