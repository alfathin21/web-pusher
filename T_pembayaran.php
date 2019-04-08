<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_pembayaran_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {   
         $judul['atas'] = "Daftar Pembayaran";

            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_pembayaran/t_pembayaran_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_pembayaran_model->json();
    }


    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_pembayaran/create_action'),
    	    'id_pembayaran' => set_value('id_pembayaran'),
    	    'jenis_pembayaran' => set_value('jenis_pembayaran'),
    	    'status_pembayaran' => set_value('status_pembayaran'),
	);

            $judul['atas'] = "Tambah Metode Pembayaran";

            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_pembayaran/t_pembayaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
		'status_pembayaran' => $this->input->post('status_pembayaran',TRUE),
	    );

            $this->T_pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_pembayaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_pembayaran/update_action'),
		'id_pembayaran' => set_value('id_pembayaran', $row->id_pembayaran),
		'jenis_pembayaran' => set_value('jenis_pembayaran', $row->jenis_pembayaran),
		'status_pembayaran' => set_value('status_pembayaran', $row->status_pembayaran),
	    );
            $judul['atas'] = "Ubah Metode Pembayaran";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_pembayaran/t_pembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pembayaran', TRUE));
        } else {
            $data = array(
		'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
		'status_pembayaran' => $this->input->post('status_pembayaran',TRUE),
	    );

            $this->T_pembayaran_model->update($this->input->post('id_pembayaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_pembayaran_model->get_by_id($id);

        if ($row) {
            $this->T_pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_pembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenis_pembayaran', 'jenis pembayaran', 'trim|required');
	$this->form_validation->set_rules('status_pembayaran', 'status pembayaran', 'trim|required');

	$this->form_validation->set_rules('id_pembayaran', 'id_pembayaran', 'trim');
	$this->form_validation->set_error_delimiters('</br> <span class="text-danger">', '</span>');
    }

}
