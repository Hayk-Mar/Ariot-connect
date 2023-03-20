<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends HM_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Main_model');
        $this->user = $this->User_model->login_user();
        if ($this->user['login'] != 'OK') {
            header('Location: ' . base_url() . 'auth/login');
            exit;
        }

        $this->raspberries = $this->Main_model->select('raspberries', 0, ['user_id' => $this->user['user']['id'], 'deleted' => NULL]);

        if (empty($this->raspberries)) {
            header('Location: ' . base_url() . 'account');
            exit;
        }

        $this->url = 'logs/';
    }

    public function index()
    {
        $this->dates = !empty($_GET['dates']) ? [$_GET['dates'][0], $_GET['dates'][1]] : [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')];
        [$this->currentRaspUUID, $this->logs] = $this->getLogs(!empty($_GET['rasp']) ? $_GET['rasp'] : 0, $this->dates);
        $this->getLayouts($this->url . 'index');
    }

    public function getLogsAsync()
    {
        $this->dates = !empty($_GET['dates']) ? [$_GET['dates'][0], $_GET['dates'][1]] : [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')];
        [$this->currentRaspUUID, $this->logs] = $this->getLogs(!empty($_GET['rasp']) ? $_GET['rasp'] : 0, $this->dates);
        $this->load->view($this->url . 'logs');
    }

    private function getLogs($raspUUID = 0, $dateRange = [])
    {
        if($raspUUID === 0) {
            $raspUUID = $this->raspberries[0]['uuid'];
        } else {
            foreach($this->raspberries as $key) {
                if(in_array($raspUUID, $key)) {
                    $raspUUID = $key['uuid'];
                    break;
                }
            }
        }
        $logs = $this->Main_model->get_query(
            'select kw, cost, createdAt from raspberry_records where createdAt BETWEEN "' . $dateRange[0] . ' 00:00:00" and "' . $dateRange[1] . ' 23:59:59" and raspberry_uuid = "' . $raspUUID . '" ORDER BY createdAt DESC'
        );

        return [$raspUUID, $logs];
    }
}
