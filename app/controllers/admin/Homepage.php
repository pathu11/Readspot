<?php 


class Homepage
{
	use Controller;
	
	public function index()
	{
		$this->viewadmin('homepage');
	}
}
