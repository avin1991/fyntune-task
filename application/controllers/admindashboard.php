<?php

class Admindashboard extends CI_controller
{
	function index()
	{
		//echo "ok";
		// if(empty($this->session->userdata['user']))
		// {
		// 	redirect(base_url().'login');
		// }
		// echo "<a href='".base_url().'admindashboard/signout'."'>Sign Out</a>";
		$this->load->view('admin/dashboard');
	}

	function signOut()
	{
		$this->session->unset_userdata('user');
		redirect(base_url().'login');
	}
}

?>