<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_tindakan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_tindakan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Tindakan";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_tindakan/t_tindakan_list', $judul);
     
        
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_tindakan_model->json();
    }

  

    public function create() 
    {


        $data = array(
            'button' => 'Create',
            'action' => site_url('t_tindakan/create_action'),
            'id_tindakan' => set_value('id_tindakan'),
            'nama_tindakan' => set_value('nama_tindakan'),
            'tarif' => set_value('tarif'),
    );
        $judul['atas'] = "Tambah Data Tindakan";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_tindakan/t_tindakan_form', $data);
        $this->load->view('template/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_tindakan' => $this->input->post('nama_tindakan',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->T_tindakan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_tindakan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_tindakan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_tindakan/update_action'),
                'id_tindakan' => set_value('id_tindakan', $row->id_tindakan),
                'nama_tindakan' => set_value('nama_tindakan', $row->nama_tindakan),
                'tarif' => set_value('tarif', $row->tarif),
	    );

            $judul['atas'] = "Ubah Data Tindakan";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_tindakan/t_tindakan_form', $data);
            $this->load->view('template/footer');
          
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_tindakan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tindakan', TRUE));
        } else {
            $data = array(
		'nama_tindakan' => $this->input->post('nama_tindakan',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
	    );

            $this->T_tindakan_model->update($this->input->post('id_tindakan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_tindakan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_tindakan_model->get_by_id($id);

        if ($row) {
            $this->T_tindakan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_tindakan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_tindakan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_tindakan', 'nama tindakan', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required|numeric');
	$this->form_validation->set_rules('id_tindakan', 'id_tindakan', 'trim');
	$this->form_validation->set_error_delimiters('<br> <span class="text-danger">', '</span>');
    }

}

