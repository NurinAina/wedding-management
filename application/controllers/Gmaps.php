<?php
class Gmaps extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        //$this->load->library('Googlemaps');

        //$config['center'] = '37.4419, -122.1419';
        //$config['zoom'] = 'auto';
        //$this->googlemaps->initialize($config);

        //$marker = array();
        //$marker['position'] = '37.429, -122.1419';
        //$this->googlemaps->add_marker($marker);
        //$data['map'] = $this->googlemaps->create_map();

        $this->load->view('location');
    }
}
