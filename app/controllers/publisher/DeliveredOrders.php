<?php 

/**
 * home class
 */
class DeliveredOrders
{
	use Controller;

	public function index()
	{

		$this->viewpub('deliveredorders');
	}

}
