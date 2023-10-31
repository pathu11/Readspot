<?php 

/**
 * home class
 */
class ShippedOrders
{
	use Controller;

	public function index()
	{

		$this->viewpub('shippedorders');
	}

}
