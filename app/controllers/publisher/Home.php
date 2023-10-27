<?php 

/**
 * home class
 */
class Home
{
	use Controller;

	public function index()
	{

		$this->viewpub('home');
	}

}
