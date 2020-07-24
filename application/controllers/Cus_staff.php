<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cus_staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cus_staff_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'cus_staff/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cus_staff/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cus_staff/index.html';
            $config['first_url'] = base_url() . 'cus_staff/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Cus_staff_model->total_rows($q);
        $cus_staff = $this->Cus_staff_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'cus_staff_data' => $cus_staff,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('cus_staff/cus_staff_list', $data);
    }

    public function read($id)
    {
        $row = $this->Cus_staff_model->get_by_id($id);
        if ($row) {
            $data = array(
                'cus_staffId' => $row->cus_staffId,
                'staffId' => $row->staffId,
                'cusId' => $row->cusId,
            );
            $this->load->view('cus_staff/cus_staff_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cus_staff'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cus_staff/create_action'),
            'cus_staffId' => set_value('cus_staffId'),
            'staffId' => set_value('staffId'),
            'cusId' => set_value('cusId'),
        );
        $this->load->view('cus_staff/cus_staff_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'staffId' => $this->input->post('staffId', TRUE),
                'cusId' => $this->input->post('cusId', TRUE),
            );

            $this->Cus_staff_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cus_staff'));
        }
    }

    public function update($id)
    {
        $row = $this->Cus_staff_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cus_staff/update_action'),
                'cus_staffId' => set_value('cus_staffId', $row->cus_staffId),
                'staffId' => set_value('staffId', $row->staffId),
                'cusId' => set_value('cusId', $row->cusId),
            );
            $this->load->view('cus_staff/cus_staff_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cus_staff'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('cus_staffId', TRUE));
        } else {
            $data = array(
                'staffId' => $this->input->post('staffId', TRUE),
                'cusId' => $this->input->post('cusId', TRUE),
            );

            $this->Cus_staff_model->update($this->input->post('cus_staffId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cus_staff'));
        }
    }

    public function delete($id)
    {
        $row = $this->Cus_staff_model->get_by_id($id);

        if ($row) {
            $this->Cus_staff_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cus_staff'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cus_staff'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('staffId', 'staffid', 'trim|required');
        $this->form_validation->set_rules('cusId', 'cusid', 'trim|required');

        $this->form_validation->set_rules('cus_staffId', 'cus_staffId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cus_staff.xls";
        $judul = "cus_staff";
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
        xlsWriteLabel($tablehead, $kolomhead++, "StaffId");
        xlsWriteLabel($tablehead, $kolomhead++, "CusId");

        foreach ($this->Cus_staff_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->staffId);
            xlsWriteNumber($tablebody, $kolombody++, $data->cusId);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cus_staff.doc");

        $data = array(
            'cus_staff_data' => $this->Cus_staff_model->get_all(),
            'start' => 0
        );

        $this->load->view('cus_staff/cus_staff_doc', $data);
    }
}
