<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'product/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product/index.html';
            $config['first_url'] = base_url() . 'product/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_model->total_rows($q);
        $product = $this->Product_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_data' => $product,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('product/product_list', $data);
    }

    public function read($id)
    {
        $row = $this->Product_model->get_by_id($id);
        if ($row) {
            $data = array(
                'proId' => $row->proId,
                'proName' => $row->proName,
                'proPrice' => $row->proPrice,
                'desId' => $row->desId,
            );
            $this->load->view('product/product_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product/create_action'),
            'proId' => set_value('proId'),
            'proName' => set_value('proName'),
            'proPrice' => set_value('proPrice'),
            'desId' => set_value('desId'),
        );
        $this->load->view('product/product_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'proName' => $this->input->post('proName', TRUE),
                'proPrice' => $this->input->post('proPrice', TRUE),
                'desId' => $this->input->post('desId', TRUE),
            );

            $this->Product_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('product'));
        }
    }

    public function update($id)
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product/update_action'),
                'proId' => set_value('proId', $row->proId),
                'proName' => set_value('proName', $row->proName),
                'proPrice' => set_value('proPrice', $row->proPrice),
                'desId' => set_value('desId', $row->desId),
            );
            $this->load->view('product/product_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('proId', TRUE));
        } else {
            $data = array(
                'proName' => $this->input->post('proName', TRUE),
                'proPrice' => $this->input->post('proPrice', TRUE),
                'desId' => $this->input->post('desId', TRUE),
            );

            $this->Product_model->update($this->input->post('proId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('product'));
        }
    }

    public function delete($id)
    {
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('proName', 'proname', 'trim|required');
        $this->form_validation->set_rules('proPrice', 'proprice', 'trim|required');
        $this->form_validation->set_rules('desId', 'desid', 'trim|required');

        $this->form_validation->set_rules('proId', 'proId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "product.xls";
        $judul = "product";
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
        xlsWriteLabel($tablehead, $kolomhead++, "ProName");
        xlsWriteLabel($tablehead, $kolomhead++, "ProPrice");
        xlsWriteLabel($tablehead, $kolomhead++, "DesId");

        foreach ($this->Product_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->proName);
            xlsWriteNumber($tablebody, $kolombody++, $data->proPrice);
            xlsWriteNumber($tablebody, $kolombody++, $data->desId);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=product.doc");

        $data = array(
            'product_data' => $this->Product_model->get_all(),
            'start' => 0
        );

        $this->load->view('product/product_doc', $data);
    }
}
