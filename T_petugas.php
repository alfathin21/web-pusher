<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_petugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_petugas_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Daftar Petugas";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_petugas/t_petugas_list', $judul);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_petugas_model->json();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_petugas/create_action'),
    	    'id_petugas' => set_value('id_petugas'),
    	    'id_bagian' => set_value('id_bagian'),
    	    'nama_petugas' => set_value('nama_petugas'),
    	    'hp' => set_value('hp'),
    	    'alamat' => set_value('alamat'),
	);
        $judul['atas'] = "Tambah Petugas";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_petugas/t_petugas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    		'id_bagian' => $this->input->post('id_bagian',TRUE),
    		'nama_petugas' => $this->input->post('nama_petugas',TRUE),
    		'hp' => $this->input->post('hp',TRUE),
    		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_petugas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_petugas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_petugas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_petugas/update_action'),
        		'id_petugas' => set_value('id_petugas', $row->id_petugas),
        		'id_bagian' => set_value('id_bagian', $row->id_bagian),
        		'nama_petugas' => set_value('nama_petugas', $row->nama_petugas),
        		'hp' => set_value('hp', $row->hp),
		        'alamat' => set_value('alamat', $row->alamat),
	    );
            $judul['atas'] = "Ubah Petugas";
            $this->load->view('template/header', $judul);
            $this->load->view('template/topbar');
            $this->load->view('template/sidebar');
            $this->load->view('t_petugas/t_petugas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_petugas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_petugas', TRUE));
        } else {
            $data = array(
		'id_bagian' => $this->input->post('id_bagian',TRUE),
		'nama_petugas' => $this->input->post('nama_petugas',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_petugas_model->update($this->input->post('id_petugas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_petugas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_petugas_model->get_by_id($id);

        if ($row) {
            $this->T_petugas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_petugas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_petugas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_bagian', 'id bagian', 'trim|required');
	$this->form_validation->set_rules('nama_petugas', 'nama petugas', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('id_petugas', 'id_petugas', 'trim');
	$this->form_validation->set_error_delimiters('</br><span class="text-danger">', '</span>');
    }

}
