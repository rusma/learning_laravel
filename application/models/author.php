<?php

class Author extends Eloquent
{
	public function posts()
	{
		return $this->has_many('Post');
	}
}