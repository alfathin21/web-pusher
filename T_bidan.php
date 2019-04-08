<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_bidan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_bidan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Daftar Bidan";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_bidan/t_bidan_list', $judul);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_bidan_model->json();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_bidan/create_action'),
    	    'id' => set_value('id'),
    	    'id_spesialis' => set_value('id_spesialis'),
    	    'id_poliklinik' => set_value('id_poliklinik'),
    	    'nama' => set_value('nama'),
    	    'hp' => set_value('hp'),
    	    'pendidikan' => set_value('pendidikan'),
    	    'alamat' => set_value('alamat'),
	);
            $judul['atas'] = "Tambah Bidan";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_bidan/t_bidan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_spesialis' => $this->input->post('id_spesialis',TRUE),
		'id_poliklinik' => $this->input->post('id_poliklinik',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_bidan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_bidan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_bidan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_bidan/update_action'),
        		'id' => set_value('id', $row->id),
        		'id_spesialis' => set_value('id_spesialis', $row->id_spesialis),
        		'id_poliklinik' => set_value('id_poliklinik', $row->id_poliklinik),
        		'nama' => set_value('nama', $row->nama),
        		'hp' => set_value('hp', $row->hp),
        		'pendidikan' => set_value('pendidikan', $row->pendidikan),
        		'alamat' => set_value('alamat', $row->alamat),
	    );
            $judul['atas'] = "Ubah Bidan";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_bidan/t_bidan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_bidan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_spesialis' => $this->input->post('id_spesialis',TRUE),
		'id_poliklinik' => $this->input->post('id_poliklinik',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_bidan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_bidan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_bidan_model->get_by_id($id);

        if ($row) {
            $this->T_bidan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_bidan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_bidan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_spesialis', 'id spesialis', 'trim|required');
	$this->form_validation->set_rules('id_poliklinik', 'id poliklinik', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('</br> <span class="text-danger">', '</span>');
    }

}

