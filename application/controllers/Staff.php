<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'staff/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'staff/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'staff/index.html';
            $config['first_url'] = base_url() . 'staff/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Staff_model->total_rows($q);
        $staff = $this->Staff_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'staff_data' => $staff,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('staff/staff_list', $data);
    }

    public function read($id)
    {
        $row = $this->Staff_model->get_by_id($id);
        if ($row) {
            $data = array(
                'staffId' => $row->staffId,
                'staffPass' => $row->staffPass,
                'staffName' => $row->staffName,
                'staffAdd' => $row->staffAdd,
                'staffPhone' => $row->staffPhone,
                'isActive' => $row->isActive,
                'roleId' => $row->roleId,
            );
            $this->load->view('staff/staff_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staff'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('staff/create_action'),
            'staffId' => set_value('staffId'),
            'staffPass' => set_value('staffPass'),
            'staffName' => set_value('staffName'),
            'staffAdd' => set_value('staffAdd'),
            'staffPhone' => set_value('staffPhone'),
            'isActive' => set_value('isActive'),
            'roleId' => set_value('roleId'),
        );
        $this->load->view('staff/staff_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'staffPass' => $this->input->post('staffPass', TRUE),
                'staffName' => $this->input->post('staffName', TRUE),
                'staffAdd' => $this->input->post('staffAdd', TRUE),
                'staffPhone' => $this->input->post('staffPhone', TRUE),
                'isActive' => $this->input->post('isActive', TRUE),
                'roleId' => $this->input->post('roleId', TRUE),
            );

            $this->Staff_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('staff'));
        }
    }

    public function update($id)
    {
        $row = $this->Staff_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('staff/update_action'),
                'staffId' => set_value('staffId', $row->staffId),
                'staffPass' => set_value('staffPass', $row->staffPass),
                'staffName' => set_value('staffName', $row->staffName),
                'staffAdd' => set_value('staffAdd', $row->staffAdd),
                'staffPhone' => set_value('staffPhone', $row->staffPhone),
                'isActive' => set_value('isActive', $row->isActive),
                'roleId' => set_value('roleId', $row->roleId),
            );
            $this->load->view('staff/staff_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staff'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('staffId', TRUE));
        } else {
            $data = array(
                'staffPass' => $this->input->post('staffPass', TRUE),
                'staffName' => $this->input->post('staffName', TRUE),
                'staffAdd' => $this->input->post('staffAdd', TRUE),
                'staffPhone' => $this->input->post('staffPhone', TRUE),
                'isActive' => $this->input->post('isActive', TRUE),
                'roleId' => $this->input->post('roleId', TRUE),
            );

            $this->Staff_model->update($this->input->post('staffId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('staff'));
        }
    }

    public function delete($id)
    {
        $row = $this->Staff_model->get_by_id($id);

        if ($row) {
            $this->Staff_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('staff'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('staff'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('staffPass', 'staffpass', 'trim|required');
        $this->form_validation->set_rules('staffName', 'staffname', 'trim|required');
        $this->form_validation->set_rules('staffAdd', 'staffadd', 'trim|required');
        $this->form_validation->set_rules('staffPhone', 'staffphone', 'trim|required');
        $this->form_validation->set_rules('isActive', 'isactive', 'trim|required');
        $this->form_validation->set_rules('roleId', 'roleid', 'trim|required');

        $this->form_validation->set_rules('staffId', 'staffId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "staff.xls";
        $judul = "staff";
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
        xlsWriteLabel($tablehead, $kolomhead++, "StaffPass");
        xlsWriteLabel($tablehead, $kolomhead++, "StaffName");
        xlsWriteLabel($tablehead, $kolomhead++, "StaffAdd");
        xlsWriteLabel($tablehead, $kolomhead++, "StaffPhone");
        xlsWriteLabel($tablehead, $kolomhead++, "IsActive");
        xlsWriteLabel($tablehead, $kolomhead++, "RoleId");

        foreach ($this->Staff_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->staffPass);
            xlsWriteLabel($tablebody, $kolombody++, $data->staffName);
            xlsWriteLabel($tablebody, $kolombody++, $data->staffAdd);
            xlsWriteNumber($tablebody, $kolombody++, $data->staffPhone);
            xlsWriteNumber($tablebody, $kolombody++, $data->isActive);
            xlsWriteNumber($tablebody, $kolombody++, $data->roleId);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=staff.doc");

        $data = array(
            'staff_data' => $this->Staff_model->get_all(),
            'start' => 0
        );

        $this->load->view('staff/staff_doc', $data);
    }
}

/* End of file Staff.php */
/* Location: ./application/controllers/Staff.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-23 16:08:03 */
/* http://harviacode.com */