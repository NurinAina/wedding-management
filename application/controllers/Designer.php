<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Designer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'designer/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'designer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'designer/index.html';
            $config['first_url'] = base_url() . 'designer/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Designer_model->total_rows($q);
        $designer = $this->Designer_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'designer_data' => $designer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('designer/designer_list', $data);
    }

    public function read($id)
    {
        $row = $this->Designer_model->get_by_id($id);
        if ($row) {
            $data = array(
                'desId' => $row->desId,
                'desName' => $row->desName,
                'desPhone' => $row->desPhone,
                'desAdd' => $row->desAdd,
            );
            $this->load->view('designer/designer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('designer'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('designer/create_action'),
            'desId' => set_value('desId'),
            'desName' => set_value('desName'),
            'desPhone' => set_value('desPhone'),
            'desAdd' => set_value('desAdd'),
        );
        $this->load->view('designer/designer_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'desName' => $this->input->post('desName', TRUE),
                'desPhone' => $this->input->post('desPhone', TRUE),
                'desAdd' => $this->input->post('desAdd', TRUE),
            );

            $this->Designer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('designer'));
        }
    }

    public function update($id)
    {
        $row = $this->Designer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('designer/update_action'),
                'desId' => set_value('desId', $row->desId),
                'desName' => set_value('desName', $row->desName),
                'desPhone' => set_value('desPhone', $row->desPhone),
                'desAdd' => set_value('desAdd', $row->desAdd),
            );
            $this->load->view('designer/designer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('designer'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('desId', TRUE));
        } else {
            $data = array(
                'desName' => $this->input->post('desName', TRUE),
                'desPhone' => $this->input->post('desPhone', TRUE),
                'desAdd' => $this->input->post('desAdd', TRUE),
            );

            $this->Designer_model->update($this->input->post('desId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('designer'));
        }
    }

    public function delete($id)
    {
        $row = $this->Designer_model->get_by_id($id);

        if ($row) {
            $this->Designer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('designer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('designer'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('desName', 'desname', 'trim|required');
        $this->form_validation->set_rules('desPhone', 'desphone', 'trim|required');
        $this->form_validation->set_rules('desAdd', 'desadd', 'trim|required');

        $this->form_validation->set_rules('desId', 'desId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "designer.xls";
        $judul = "designer";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //header
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
        xlsWriteLabel($tablehead, $kolomhead++, "DesName");
        xlsWriteLabel($tablehead, $kolomhead++, "DesPhone");
        xlsWriteLabel($tablehead, $kolomhead++, "DesAdd");

        foreach ($this->Designer_model->get_all() as $data) {
            $kolombody = 0;

            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->desName);
            xlsWriteNumber($tablebody, $kolombody++, $data->desPhone);
            xlsWriteLabel($tablebody, $kolombody++, $data->desAdd);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=designer.doc");

        $data = array(
            'designer_data' => $this->Designer_model->get_all(),
            'start' => 0
        );

        $this->load->view('designer/designer_doc', $data);
    }
}
