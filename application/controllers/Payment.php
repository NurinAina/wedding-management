<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'payment/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'payment/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'payment/index.html';
            $config['first_url'] = base_url() . 'payment/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Payment_model->total_rows($q);
        $payment = $this->Payment_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'payment_data' => $payment,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('payment/payment_list', $data);
    }

    public function read($id)
    {
        $row = $this->Payment_model->get_by_id($id);
        if ($row) {
            $data = array(
                'payId' => $row->payId,
                'payStatus' => $row->payStatus,
                'payDate' => $row->payDate,
            );
            $this->load->view('payment/payment_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('payment/create_action'),
            'payId' => set_value('payId'),
            'payStatus' => set_value('payStatus'),
            'payDate' => set_value('payDate'),
        );
        $this->load->view('payment/payment_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'payStatus' => $this->input->post('payStatus', TRUE),
                'payDate' => $this->input->post('payDate', TRUE),
            );

            $this->Payment_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('payment'));
        }
    }

    public function update($id)
    {
        $row = $this->Payment_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('payment/update_action'),
                'payId' => set_value('payId', $row->payId),
                'payStatus' => set_value('payStatus', $row->payStatus),
                'payDate' => set_value('payDate', $row->payDate),
            );
            $this->load->view('payment/payment_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('payId', TRUE));
        } else {
            $data = array(
                'payStatus' => $this->input->post('payStatus', TRUE),
                'payDate' => $this->input->post('payDate', TRUE),
            );

            $this->Payment_model->update($this->input->post('payId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('payment'));
        }
    }

    public function delete($id)
    {
        $row = $this->Payment_model->get_by_id($id);

        if ($row) {
            $this->Payment_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('payment'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('payStatus', 'paystatus', 'trim|required');
        $this->form_validation->set_rules('payDate', 'paydate', 'trim|required');

        $this->form_validation->set_rules('payId', 'payId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "payment.xls";
        $judul = "payment";
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
        xlsWriteLabel($tablehead, $kolomhead++, "PayStatus");
        xlsWriteLabel($tablehead, $kolomhead++, "PayDate");

        foreach ($this->Payment_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->payStatus);
            xlsWriteLabel($tablebody, $kolombody++, $data->payDate);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=payment.doc");

        $data = array(
            'payment_data' => $this->Payment_model->get_all(),
            'start' => 0
        );

        $this->load->view('payment/payment_doc', $data);
    }
}
