<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_bagian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_bagian_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Daftar Bagian Karyawan";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_bagian/t_bagian_list', $judul);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_bagian_model->json();
    }



    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_bagian/create_action'),
    	    'id_bagian' => set_value('id_bagian'),
    	    'nama_bagian' => set_value('nama_bagian'),
	);
        $judul['atas'] = "Tambah Data Bagian ";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_bagian/t_bagian_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_bagian' => $this->input->post('nama_bagian',TRUE),
	    );

            $this->T_bagian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_bagian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_bagian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_bagian/update_action'),
        		'id_bagian' => set_value('id_bagian', $row->id_bagian),
        		'nama_bagian' => set_value('nama_bagian', $row->nama_bagian),
	    );
            $judul['atas'] = "Ubah Data Bagian ";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_bagian/t_bagian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_bagian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bagian', TRUE));
        } else {
            $data = array(
		'nama_bagian' => $this->input->post('nama_bagian',TRUE),
	    );

            $this->T_bagian_model->update($this->input->post('id_bagian', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_bagian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_bagian_model->get_by_id($id);

        if ($row) {
            $this->T_bagian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_bagian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_bagian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_bagian', 'nama bagian', 'trim|required');

	$this->form_validation->set_rules('id_bagian', 'id_bagian', 'trim');
	$this->form_validation->set_error_delimiters('</br><span class="text-danger">', '</span>');
    }

}

