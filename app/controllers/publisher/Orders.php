<?php 

/**
 * home class
 */
class Orders
{
	use Controller;

	public function index()
	{

		$this->viewpub('orders');
	}

}
