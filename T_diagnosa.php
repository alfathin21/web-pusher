<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_diagnosa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_diagnosa_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Daftar Diagnosa";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_diagnosa/t_diagnosa_list', $judul);

       
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_diagnosa_model->json();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_diagnosa/create_action'),
    	    'id' => set_value('id'),
    	    'nama_diagnosa' => set_value('nama_diagnosa'),
	);
            $judul['atas'] = "Tambah Diagnosa";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_diagnosa/t_diagnosa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_diagnosa' => $this->input->post('nama_diagnosa',TRUE),
	    );

            $this->T_diagnosa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_diagnosa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_diagnosa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_diagnosa/update_action'),
		'id' => set_value('id', $row->id),
		'nama_diagnosa' => set_value('nama_diagnosa', $row->nama_diagnosa),
	    );
            $judul['atas'] = "Ubah Diagnosa";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_diagnosa/t_diagnosa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_diagnosa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_diagnosa' => $this->input->post('nama_diagnosa',TRUE),
	    );

            $this->T_diagnosa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_diagnosa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_diagnosa_model->get_by_id($id);

        if ($row) {
            $this->T_diagnosa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_diagnosa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_diagnosa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_diagnosa', 'nama diagnosa', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('</br><span class="text-danger">', '</span>');
    }

}
