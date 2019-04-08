<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class D_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('d_user/user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->User_model->json();
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'GUID' => $row->GUID,
		'USERNAME' => $row->USERNAME,
		'PASSWORD' => $row->PASSWORD,
		'ISLOGIN' => $row->ISLOGIN,
		'VERIFIED' => $row->VERIFIED,
		'CODE' => $row->CODE,
		'LASTLOGIN' => $row->LASTLOGIN,
		'DTMCRT' => $row->DTMCRT,
		'DTMUPD' => $row->DTMUPD,
		'USRUPD' => $row->USRUPD,
		'ACCESS' => $row->ACCESS,
		'UNIT_ID' => $row->UNIT_ID,
		'USER_DETAIL_ID' => $row->USER_DETAIL_ID,
	    );
            $this->load->view('d_user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('d_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('d_user/create_action'),
	    'GUID' => set_value('GUID'),
	    'USERNAME' => set_value('USERNAME'),
	    'PASSWORD' => set_value('PASSWORD'),
	    'ISLOGIN' => set_value('ISLOGIN'),
	    'VERIFIED' => set_value('VERIFIED'),
	    'CODE' => set_value('CODE'),
	    'LASTLOGIN' => set_value('LASTLOGIN'),
	    'DTMCRT' => set_value('DTMCRT'),
	    'DTMUPD' => set_value('DTMUPD'),
	    'USRUPD' => set_value('USRUPD'),
	    'ACCESS' => set_value('ACCESS'),
	    'UNIT_ID' => set_value('UNIT_ID'),
	    'USER_DETAIL_ID' => set_value('USER_DETAIL_ID'),
	);
        $this->load->view('d_user/user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'USERNAME' => $this->input->post('USERNAME',TRUE),
		'PASSWORD' => $this->input->post('PASSWORD',TRUE),
		'ISLOGIN' => $this->input->post('ISLOGIN',TRUE),
		'VERIFIED' => $this->input->post('VERIFIED',TRUE),
		'CODE' => $this->input->post('CODE',TRUE),
		'LASTLOGIN' => $this->input->post('LASTLOGIN',TRUE),
		'DTMCRT' => $this->input->post('DTMCRT',TRUE),
		'DTMUPD' => $this->input->post('DTMUPD',TRUE),
		'USRUPD' => $this->input->post('USRUPD',TRUE),
		'ACCESS' => $this->input->post('ACCESS',TRUE),
		'UNIT_ID' => $this->input->post('UNIT_ID',TRUE),
		'USER_DETAIL_ID' => $this->input->post('USER_DETAIL_ID',TRUE),
	    );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('d_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('d_user/update_action'),
		'GUID' => set_value('GUID', $row->GUID),
		'USERNAME' => set_value('USERNAME', $row->USERNAME),
		'PASSWORD' => set_value('PASSWORD', $row->PASSWORD),
		'ISLOGIN' => set_value('ISLOGIN', $row->ISLOGIN),
		'VERIFIED' => set_value('VERIFIED', $row->VERIFIED),
		'CODE' => set_value('CODE', $row->CODE),
		'LASTLOGIN' => set_value('LASTLOGIN', $row->LASTLOGIN),
		'DTMCRT' => set_value('DTMCRT', $row->DTMCRT),
		'DTMUPD' => set_value('DTMUPD', $row->DTMUPD),
		'USRUPD' => set_value('USRUPD', $row->USRUPD),
		'ACCESS' => set_value('ACCESS', $row->ACCESS),
		'UNIT_ID' => set_value('UNIT_ID', $row->UNIT_ID),
		'USER_DETAIL_ID' => set_value('USER_DETAIL_ID', $row->USER_DETAIL_ID),
	    );
            $this->load->view('d_user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('d_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('GUID', TRUE));
        } else {
            $data = array(
		'USERNAME' => $this->input->post('USERNAME',TRUE),
		'PASSWORD' => $this->input->post('PASSWORD',TRUE),
		'ISLOGIN' => $this->input->post('ISLOGIN',TRUE),
		'VERIFIED' => $this->input->post('VERIFIED',TRUE),
		'CODE' => $this->input->post('CODE',TRUE),
		'LASTLOGIN' => $this->input->post('LASTLOGIN',TRUE),
		'DTMCRT' => $this->input->post('DTMCRT',TRUE),
		'DTMUPD' => $this->input->post('DTMUPD',TRUE),
		'USRUPD' => $this->input->post('USRUPD',TRUE),
		'ACCESS' => $this->input->post('ACCESS',TRUE),
		'UNIT_ID' => $this->input->post('UNIT_ID',TRUE),
		'USER_DETAIL_ID' => $this->input->post('USER_DETAIL_ID',TRUE),
	    );

            $this->User_model->update($this->input->post('GUID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('d_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('d_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('d_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('USERNAME', 'username', 'trim|required');
	$this->form_validation->set_rules('PASSWORD', 'password', 'trim|required');
	$this->form_validation->set_rules('ISLOGIN', 'islogin', 'trim|required');
	$this->form_validation->set_rules('VERIFIED', 'verified', 'trim|required');
	$this->form_validation->set_rules('CODE', 'code', 'trim|required');
	$this->form_validation->set_rules('LASTLOGIN', 'lastlogin', 'trim|required');
	$this->form_validation->set_rules('DTMCRT', 'dtmcrt', 'trim|required');
	$this->form_validation->set_rules('DTMUPD', 'dtmupd', 'trim|required');
	$this->form_validation->set_rules('USRUPD', 'usrupd', 'trim|required');
	$this->form_validation->set_rules('ACCESS', 'access', 'trim|required');
	$this->form_validation->set_rules('UNIT_ID', 'unit id', 'trim|required');
	$this->form_validation->set_rules('USER_DETAIL_ID', 'user detail id', 'trim|required');

	$this->form_validation->set_rules('GUID', 'GUID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file D_user.php */
/* Location: ./application/controllers/D_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-08 22:44:15 */
/* http://harviacode.com */