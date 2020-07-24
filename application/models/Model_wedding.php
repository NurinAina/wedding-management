<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_wedding extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
}
