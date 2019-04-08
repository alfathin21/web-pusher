<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends CI_Controller {


	public function index()
	{
	    $judul['atas'] = "Dashbord";
		$this->load->view('template/header' , $judul);
		$this->load->view('template/topbar');
		$this->load->view('template/sidebar');
		$this->load->view('dashbord/index');
		$this->load->view('template/footer');
	}




    
}

