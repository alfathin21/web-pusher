<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * class cntroller Render Barcode
 * Author : Alfathin Hidayatulloh
 */
class Render extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Ciqrcode');
		$this->load->library('Zend');
	}
	public function index()
	{
			$data['judul'] = "Render barcode";
			$data['nilai'] = $this->db->get('t_login')->result();
			$this->load->view('render', $data);


	}

	public function QRcode($kodenya)
	{
		// output render format image / png

		QRcode::png(
			$kodenya,
			$outfile = false,
			$level = QR_ECLEVEL_H,
			$size = 6,
			$margin = 2
		);



	}
	public function Barcode($kodenya)
	{
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
	}




}


