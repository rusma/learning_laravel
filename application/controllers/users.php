<?php  
class Users_Controller extends Base_Controller {
	public $restful = true;

	public function get_new() 
	{

		return View::make('users.new');
	}

	public function get_index()
	{
		return 'all users';	
	} 

	public function post_index()
	{
		return 'User inputted ' . e(Input::get('username')) . ' should be created';	
	}

	public function get_edit()
	{
		return 'Edit users'; 	
	}
}
?>