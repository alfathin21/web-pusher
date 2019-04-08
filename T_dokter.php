<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_dokter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_dokter_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $judul['atas'] = "Daftar Dokter";
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_dokter/t_dokter_list');
      
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_dokter_model->json();
    }

    public function read($id) 
    {
        $row = $this->T_dokter_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_dokter' => $row->id_dokter,
		'id_spesialis' => $row->id_spesialis,
		'id_poliklinik' => $row->id_poliklinik,
		'nama_dokter' => $row->nama_dokter,
		'hp' => $row->hp,
		'pendidikan' => $row->pendidikan,
		'alamat' => $row->alamat,
	    );
            $this->load->view('t_dokter/t_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_dokter'));
        }
    }

    public function create() 
    {
        
           $judul['atas'] = "Daftar Dokter";


       $data = array(
            'button' => 'Create',
            'action' => site_url('t_dokter/create_action'),
	    'id_dokter' => set_value('id_dokter'),
	    'id_spesialis' => set_value('id_spesialis'),
	    'id_poliklinik' => set_value('id_poliklinik'),
	    'nama_dokter' => set_value('nama_dokter'),
	    'hp' => set_value('hp'),
	    'pendidikan' => set_value('pendidikan'),
	    'alamat' => set_value('alamat'),
        'content' => $this->db->get('t_poliklinik')->result_array(),
	);
        $this->load->view('template/header', $judul);
        $this->load->view('template/topbar');
        $this->load->view('template/sidebar');
        $this->load->view('t_dokter/t_dokter_form', $data);
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
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_dokter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_dokter'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_dokter/update_action'),
		'id_dokter' => set_value('id_dokter', $row->id_dokter),
		'id_spesialis' => set_value('id_spesialis', $row->id_spesialis),
		'id_poliklinik' => set_value('id_poliklinik', $row->id_poliklinik),
		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
		'hp' => set_value('hp', $row->hp),
		'pendidikan' => set_value('pendidikan', $row->pendidikan),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->load->view('t_dokter/t_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_dokter'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dokter', TRUE));
        } else {
            $data = array(
		'id_spesialis' => $this->input->post('id_spesialis',TRUE),
		'id_poliklinik' => $this->input->post('id_poliklinik',TRUE),
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_dokter_model->update($this->input->post('id_dokter', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_dokter'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_dokter_model->get_by_id($id);

        if ($row) {
            $this->T_dokter_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_dokter'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_dokter'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_spesialis', 'id spesialis', 'trim|required');
	$this->form_validation->set_rules('id_poliklinik', 'id poliklinik', 'trim|required');
	$this->form_validation->set_rules('nama_dokter', 'nama dokter', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_dokter', 'id_dokter', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file T_dokter.php */
/* Location: ./application/controllers/T_dokter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-29 12:52:31 */
/* http://harviacode.com */