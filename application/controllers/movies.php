<?php

class Movies_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        return View::make('movies.index');
    }    

	public function get_show($id)
    {
        return 'showing a movie ' . $id;

    }    

	public function get_new()
    {
        return 'form create new movie';
    }

}