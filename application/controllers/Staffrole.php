<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staffrole extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Staffrole_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'staffrole/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'staffrole/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'staffrole/index.html';
            $config['first_url'] = base_url() . 'staffrole/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Staffrole_model->total_rows($q);
        $staffrole = $this->Staffrole_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'staffrole_data' => $staffrole,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('staffrole/staffrole_list', $data);
    }

    public function read($id)
    {
        $row = $this->Staffrole_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'role' => $row->role,
            );
            $this->load->view('staffrole/staffrole_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staffrole'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('staffrole/create_action'),
            'id' => set_value('id'),
            'role' => set_value('role'),
        );
        $this->load->view('staffrole/staffrole_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'role' => $this->input->post('role', TRUE),
            );

            $this->Staffrole_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('staffrole'));
        }
    }

    public function update($id)
    {
        $row = $this->Staffrole_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('staffrole/update_action'),
                'id' => set_value('id', $row->id),
                'role' => set_value('role', $row->role),
            );
            $this->load->view('staffrole/staffrole_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staffrole'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'role' => $this->input->post('role', TRUE),
            );

            $this->Staffrole_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('staffrole'));
        }
    }

    public function delete($id)
    {
        $row = $this->Staffrole_model->get_by_id($id);

        if ($row) {
            $this->Staffrole_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('staffrole'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staffrole'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('role', 'role', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "staffrole.xls";
        $judul = "staffrole";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        // header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Role");

        foreach ($this->Staffrole_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->role);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=staffrole.doc");

        $data = array(
            'staffrole_data' => $this->Staffrole_model->get_all(),
            'start' => 0
        );

        $this->load->view('staffrole/staffrole_doc', $data);
    }
}
