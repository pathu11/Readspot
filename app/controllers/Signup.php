<?php 

/**
 * signup class
 */
class Signup
{
	use Controller;

	public function index()
	{
		$data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$user = new User;
			if($user->validate($_POST))
			{
				$user->insert($_POST);
				redirect('login');
			}
            $user->errors['email'] = "Wrong email or password";

			$data['errors'] = $user->errors="wrong";			
		}


		$this->view('signup',$data);
	}

}
