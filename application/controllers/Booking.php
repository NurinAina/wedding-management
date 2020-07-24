<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'booking/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'booking/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'booking/index.html';
            $config['first_url'] = base_url() . 'booking/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Booking_model->total_rows($q);
        $booking = $this->Booking_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'booking_data' => $booking,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('booking/booking_list', $data);
    }

    public function read($id)
    {
        $row = $this->Booking_model->get_by_id($id);
        if ($row) {
            $data = array(
                'bookId' => $row->bookId,
                'bookDate' => $row->bookDate,
                'proId' => $row->proId,
                'payId' => $row->payId,
            );
            $this->load->view('booking/booking_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('booking'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('booking/create_action'),
            'bookId' => set_value('bookId'),
            'bookDate' => set_value('bookDate'),
            'proId' => set_value('proId'),
            'payId' => set_value('payId'),
        );
        $this->load->view('booking/booking_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'bookDate' => $this->input->post('bookDate', TRUE),
                'proId' => $this->input->post('proId', TRUE),
                'payId' => $this->input->post('payId', TRUE),
            );

            $this->Booking_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('booking'));
        }
    }

    public function update($id)
    {
        $row = $this->Booking_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('booking/update_action'),
                'bookId' => set_value('bookId', $row->bookId),
                'bookDate' => set_value('bookDate', $row->bookDate),
                'proId' => set_value('proId', $row->proId),
                'payId' => set_value('payId', $row->payId),
            );
            $this->load->view('booking/booking_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('booking'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('bookId', TRUE));
        } else {
            $data = array(
                'bookDate' => $this->input->post('bookDate', TRUE),
                'proId' => $this->input->post('proId', TRUE),
                'payId' => $this->input->post('payId', TRUE),
            );

            $this->Booking_model->update($this->input->post('bookId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('booking'));
        }
    }

    public function delete($id)
    {
        $row = $this->Booking_model->get_by_id($id);

        if ($row) {
            $this->Booking_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('booking'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('booking'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('bookDate', 'bookdate', 'trim|required');
        $this->form_validation->set_rules('proId', 'proid', 'trim|required');
        $this->form_validation->set_rules('payId', 'payid', 'trim|required');

        $this->form_validation->set_rules('bookId', 'bookId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "booking.xls";
        $judul = "booking";
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
        xlsWriteLabel($tablehead, $kolomhead++, "BookDate");
        xlsWriteLabel($tablehead, $kolomhead++, "ProId");
        xlsWriteLabel($tablehead, $kolomhead++, "PayId");

        foreach ($this->Booking_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->bookDate);
            xlsWriteNumber($tablebody, $kolombody++, $data->proId);
            xlsWriteNumber($tablebody, $kolombody++, $data->payId);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=booking.doc");

        $data = array(
            'booking_data' => $this->Booking_model->get_all(),
            'start' => 0
        );

        $this->load->view('booking/booking_doc', $data);
    }
}
