<?php

class Create_Movies_Table {    

	public function up()
    {
		Schema::create('movies', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('genre');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('movies');

    }

}