<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_kelas_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
            $judul['atas'] = "Daftar Kelas Ruangan";

            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_kelas/t_kelas_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_kelas_model->json();
    }

   
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_kelas/create_action'),
    	    'id_kelas' => set_value('id_kelas'),
    	    'nama_kelas' => set_value('nama_kelas'),
    	    'tarif' => set_value('tarif'),
    	    'fasilitas' => set_value('fasilitas'),
	);
           $judul['atas'] = "Tambah Daftar Kelas Ruangan";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_kelas/t_kelas_form', $data);
    
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
		'fasilitas' => $this->input->post('fasilitas',TRUE),
	    );

            $this->T_kelas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_kelas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_kelas/update_action'),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
		'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
		'tarif' => set_value('tarif', $row->tarif),
		'fasilitas' => set_value('fasilitas', $row->fasilitas),
	    );
            $judul['atas'] = "Ubah Daftar Kelas Ruangan";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_kelas/t_kelas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_kelas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
		'tarif' => $this->input->post('tarif',TRUE),
		'fasilitas' => $this->input->post('fasilitas',TRUE),
	    );

            $this->T_kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_kelas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_kelas_model->get_by_id($id);

        if ($row) {
            $this->T_kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_kelas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');
	$this->form_validation->set_rules('tarif', 'tarif', 'trim|required|numeric');
	$this->form_validation->set_rules('fasilitas', 'fasilitas', 'trim|required');

	$this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
	$this->form_validation->set_error_delimiters('</br> <span class="text-danger">', '</span>');
    }

}

