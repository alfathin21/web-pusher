<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_perawat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T_perawat_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('t_perawat/t_perawat_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->T_perawat_model->json();
    }

    public function read($id) 
    {
        $row = $this->T_perawat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_perawat' => $row->id_perawat,
		'id_dokter' => $row->id_dokter,
		'nama_perawat' => $row->nama_perawat,
		'hp' => $row->hp,
		'alamat' => $row->alamat,
	    );
            $this->load->view('t_perawat/t_perawat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_perawat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('t_perawat/create_action'),
	    'id_perawat' => set_value('id_perawat'),
	    'id_dokter' => set_value('id_dokter'),
	    'nama_perawat' => set_value('nama_perawat'),
	    'hp' => set_value('hp'),
	    'alamat' => set_value('alamat'),
	);
        $this->load->view('t_perawat/t_perawat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_dokter' => $this->input->post('id_dokter',TRUE),
		'nama_perawat' => $this->input->post('nama_perawat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_perawat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t_perawat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->T_perawat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('t_perawat/update_action'),
		'id_perawat' => set_value('id_perawat', $row->id_perawat),
		'id_dokter' => set_value('id_dokter', $row->id_dokter),
		'nama_perawat' => set_value('nama_perawat', $row->nama_perawat),
		'hp' => set_value('hp', $row->hp),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->load->view('t_perawat/t_perawat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_perawat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perawat', TRUE));
        } else {
            $data = array(
		'id_dokter' => $this->input->post('id_dokter',TRUE),
		'nama_perawat' => $this->input->post('nama_perawat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->T_perawat_model->update($this->input->post('id_perawat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t_perawat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->T_perawat_model->get_by_id($id);

        if ($row) {
            $this->T_perawat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t_perawat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t_perawat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_dokter', 'id dokter', 'trim|required');
	$this->form_validation->set_rules('nama_perawat', 'nama perawat', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_perawat', 'id_perawat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file T_perawat.php */
/* Location: ./application/controllers/T_perawat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-29 13:20:48 */
/* http://harviacode.com */