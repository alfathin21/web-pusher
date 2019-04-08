<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_poliklinik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_poliklinik_model');
        $this->load->library('form_validation');        
	   $this->load->library('datatables');
    }

    public function index()
    {   

        $judul['atas'] = "Poliklinik";

        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_poliklinik/t_poliklinik_list', $judul);

    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_poliklinik_model->json();
    }

   

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_poliklinik/create_action'),
	    'id_poliklinik' => set_value('id_poliklinik'),
	    'nama_poliklinik' => set_value('nama_poliklinik'),
	    'lantai' => set_value('lantai'),
	);
         $judul['atas'] = "Tambah Poliklinik";

        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_poliklinik/t_poliklinik_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_poliklinik' => $this->input->post('nama_poliklinik',TRUE),
		'lantai' => $this->input->post('lantai',TRUE),
	    );

            $this->T_poliklinik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_poliklinik'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_poliklinik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_poliklinik/update_action'),
        		'id_poliklinik' => set_value('id_poliklinik', $row->id_poliklinik),
        		'nama_poliklinik' => set_value('nama_poliklinik', $row->nama_poliklinik),
        		'lantai' => set_value('lantai', $row->lantai),
	    );
            $judul['atas'] = "Ubah Poliklinik";

            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
           $this->load->view('t_poliklinik/t_poliklinik_form', $data);
       
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_poliklinik'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_poliklinik', TRUE));
        } else {
            $data = array(
		'nama_poliklinik' => $this->input->post('nama_poliklinik',TRUE),
		'lantai' => $this->input->post('lantai',TRUE),
	    );

            $this->T_poliklinik_model->update($this->input->post('id_poliklinik', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_poliklinik'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_poliklinik_model->get_by_id($id);

        if ($row) {
            $this->T_poliklinik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_poliklinik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_poliklinik'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_poliklinik', 'nama poliklinik', 'trim|required');
	$this->form_validation->set_rules('lantai', 'lantai', 'trim|required');

	$this->form_validation->set_rules('id_poliklinik', 'id_poliklinik', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

