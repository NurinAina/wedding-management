<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'customer/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'customer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'customer/index.html';
            $config['first_url'] = base_url() . 'customer/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Customer_model->total_rows($q);
        $customer = $this->Customer_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'customer_data' => $customer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('customer/customer_list', $data);
    }

    public function read($id)
    {
        $row = $this->Customer_model->get_by_id($id);
        if ($row) {
            $data = array(
                'cusId' => $row->cusId,
                'cusName' => $row->cusName,
                'cusPhone' => $row->cusPhone,
                'cusAdd' => $row->cusAdd,
                'bookId' => $row->bookId,
            );
            $this->load->view('customer/customer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('customer/create_action'),
            'cusId' => set_value('cusId'),
            'cusName' => set_value('cusName'),
            'cusPhone' => set_value('cusPhone'),
            'cusAdd' => set_value('cusAdd'),
            'bookId' => set_value('bookId'),
        );
        $this->load->view('customer/customer_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'cusName' => $this->input->post('cusName', TRUE),
                'cusPhone' => $this->input->post('cusPhone', TRUE),
                'cusAdd' => $this->input->post('cusAdd', TRUE),
                'bookId' => $this->input->post('bookId', TRUE),
            );

            $this->Customer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('customer'));
        }
    }

    public function update($id)
    {
        $row = $this->Customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('customer/update_action'),
                'cusId' => set_value('cusId', $row->cusId),
                'cusName' => set_value('cusName', $row->cusName),
                'cusPhone' => set_value('cusPhone', $row->cusPhone),
                'cusAdd' => set_value('cusAdd', $row->cusAdd),
                'bookId' => set_value('bookId', $row->bookId),
            );
            $this->load->view('customer/customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('cusId', TRUE));
        } else {
            $data = array(
                'cusName' => $this->input->post('cusName', TRUE),
                'cusPhone' => $this->input->post('cusPhone', TRUE),
                'cusAdd' => $this->input->post('cusAdd', TRUE),
                'bookId' => $this->input->post('bookId', TRUE),
            );

            $this->Customer_model->update($this->input->post('cusId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('customer'));
        }
    }

    public function delete($id)
    {
        $row = $this->Customer_model->get_by_id($id);

        if ($row) {
            $this->Customer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('cusName', 'cusname', 'trim|required');
        $this->form_validation->set_rules('cusPhone', 'cusphone', 'trim|required');
        $this->form_validation->set_rules('cusAdd', 'cusadd', 'trim|required');
        $this->form_validation->set_rules('bookId', 'bookid', 'trim|required');

        $this->form_validation->set_rules('cusId', 'cusId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "customer.xls";
        $judul = "customer";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
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
        xlsWriteLabel($tablehead, $kolomhead++, "CusName");
        xlsWriteLabel($tablehead, $kolomhead++, "CusPhone");
        xlsWriteLabel($tablehead, $kolomhead++, "CusAdd");
        xlsWriteLabel($tablehead, $kolomhead++, "BookId");

        foreach ($this->Customer_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->cusName);
            xlsWriteNumber($tablebody, $kolombody++, $data->cusPhone);
            xlsWriteLabel($tablebody, $kolombody++, $data->cusAdd);
            xlsWriteNumber($tablebody, $kolombody++, $data->bookId);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=customer.doc");

        $data = array(
            'customer_data' => $this->Customer_model->get_all(),
            'start' => 0
        );

        $this->load->view('customer/customer_doc', $data);
    }
}
