<?php

class Login extends CI_controller
{


	public function index()
	{
		$this->load->model('Loginmodel');
		$this->form_validation->set_rules('username', 'User Name', 'required|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[12]');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run()==false)
		{
			
			$this->load->view('admin/login');
			//echo "Login Successfully";
		}
		else
		{
			$uname = $this->input->post('username');
			$pass = $this->input->post('password');
			$user=$this->Loginmodel->isvalidate($uname,$pass);

			if(!empty($user)&& $user['role']==1)
			{
				$this->session->set_userdata('user',$user);
				redirect(base_url().'admindashboard');
			}
			if(!empty($user) && $user['role']==2)
			{
				$this->session->set_userdata('user',$user);
				redirect(base_url().'home');
			}
			else
			{
				$this->session->set_flashdata('errorMsg','Either Username/Password is Incorrect');
				redirect(base_url().'login');
			}
		}

	}
	
}

?>