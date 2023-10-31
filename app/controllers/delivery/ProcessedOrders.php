<?php 

/**
 * home class
 */
class ProcessedOrders
{
	use Controller;

	public function index()
	{

		$this->viewdelivery('processedorders');
	}

}
