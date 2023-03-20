<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HM_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function getLayouts($data = FALSE)
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/menu');
        if (is_array($data)) {
            foreach ($data as $view) {
                $this->load->view($view);
            }
        } else {
            $this->load->view($data);
        }
        $this->load->view('layouts/footer');
    }
}
