<?php 

/**
 * home class
 */
class Categories
{
	use Controller;

	public function index()
	{

		$this->viewadmin('categories');
	}

}
