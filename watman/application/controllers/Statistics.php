<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Statistics extends HM_Controller
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

        $this->url = 'statistics/';
    }

    public function index()
    {
        $this->dates = !empty($_GET['dates']) ? [$_GET['dates'][0], $_GET['dates'][1]] : [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')];
        $this->period = !empty($_GET['period']) ? $_GET['period'] : 2;
        [$this->currentRaspUUID, $this->records] = $this->getStatistics(!empty($_GET['rasp']) ? $_GET['rasp'] : 0, $this->dates, $this->period);
        $this->getLayouts($this->url . 'index');
    }

    public function getStatisticsAsync()
    {
        $this->dates = !empty($_GET['dates']) ? [$_GET['dates'][0], $_GET['dates'][1]] : [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')];
        $this->period = !empty($_GET['period']) ? $_GET['period'] : 2;
        [$this->currentRaspUUID, $this->records] = $this->getStatistics(!empty($_GET['rasp']) ? $_GET['rasp'] : 0, $this->dates, $this->period);
        $this->load->view($this->url . 'chart');
    }

    private function getStatistics($raspUUID = 0, $dateRange = [], $period = 2)
    {
        if ($raspUUID === 0) {
            $raspUUID = $this->raspberries[0]['uuid'];
        } else {
            foreach ($this->raspberries as $key) {
                if (in_array($raspUUID, $key)) {
                    $raspUUID = $key['uuid'];
                    break;
                }
            }
        }

        if ($period == 1) {
            $formatType1 = "DATE_FORMAT(rs.createdAt, '%Y-%m'";
            $formatType2 = "DATE_FORMAT(r.createdAt, '%Y-%m')";
        } else if ($period == 2) {
            $formatType1 = "cast(rs.createdAt as date)";
            $formatType2 = "cast(r.createdAt as date)";
        } else if ($period == 3) {
            $formatType1 = "DATE_FORMAT(rs.createdAt, '%Y-%m-%e-%H'))";
            $formatType2 = "DATE_FORMAT(r.createdAt, '%Y-%m-%e-%H')";
        }

        $records = $this->Main_model->get_query(
            'select id, (select MAX(count) from raspberry_records rs WHERE ' . $formatType1 . ' = ' . $formatType2 . ' and raspberry_uuid = "' . $raspUUID . '" GROUP BY ' . $formatType1 . ') as maxCount, createdAt from raspberry_records r where '
                . 'createdAt BETWEEN "' . $dateRange[0] . ' 00:00:00" and "' . $dateRange[1] . ' 23:59:59"'
                . ' and raspberry_uuid = "' . $raspUUID . '" GROUP by ' . $formatType2 . ' ORDER BY createdAt DESC'
        );


        return [$raspUUID, $records];
    }
}
