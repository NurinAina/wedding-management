<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('staffId', 'Staff Id', 'trim|required');
        $this->form_validation->set_rules('staffPass', 'Staff Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            //$data['title'] = 'ITS WEDDING';
            $this->load->view('auth/login');
        } else {
            //validation success
            $this->_login();
        }
    }

    private function _login()
    {
        $staffId = $this->input->post('staffId');
        $staffPass = $this->input->post('staffPass');

        $staff = $this->db->get_where('staff', ['staffId' => $staffId])->row_array();

        if ($staff) {
            //staff have data
            if ($staff['isActive'] == 1) {
                //password check
                if (password_verify($staffPass, $staff['staffPass'])) {
                    $data = [
                        'staffId' => $staff['staffId'],
                        'roleId' => $staff['roleId']
                    ];
                    $this->session->set_userdata($data);
                    if ($staff['roleId'] == 1) {
                        redirect('customer');
                    } else {
                        redirect('staff');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong password! </div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Id has not activated </div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Id is not registered! </div>');
            redirect('auth/login');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('staffId', 'Staff Id', 'required|numeric');
        $this->form_validation->set_rules('staffName', 'Staff  Name', 'required|trim');
        $this->form_validation->set_rules('staffAdd', 'Staff Address', 'required|trim');
        $this->form_validation->set_rules('staffPhone', 'staff Phone', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('staffPass', 'Staff Password', 'required|min_length[3]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|min_length[3]|matches[staffPass]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);

        if ($this->form_validation->run() == false) {
            //$data['title'] = 'ITS WEDDING';
            $this->load->view('auth/registration');
        } else {
            $data = [
                'staffId' => htmlspecialchars($this->input->post('staffId', true)),
                'staffName' => htmlspecialchars($this->input->post('staffName', true)),
                'staffAdd' => htmlspecialchars($this->input->post('staffAdd', true)),
                'staffPhone' => htmlspecialchars($this->input->post('staffPhone', true)),
                'staffPass' => password_hash($this->input->post('staffPass'), PASSWORD_DEFAULT),
                'roleId' => 1,
                'isActive' => 1,
            ];

            $this->db->insert('staff', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your account has been created. Please login. </div>');
            redirect('login/index');
        }
    }


    //function for logout
    public function logout()
    {
        $this->session->unset_userdata('staffId');
        $this->session->unset_userdata('roleId');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have been logout! </div>');
        redirect('login/index');
    }
}
