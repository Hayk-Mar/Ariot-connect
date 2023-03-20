<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends HM_Controller
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

        $this->url = 'admin/';
    }

    public function index($uuid = 0)
    {
        $info = $this->getInfo($uuid);
        $this->logs = $info['logs'];
        $this->records = $info['records'];
        $this->lastRecord = $info['lastRecord'];

        $this->getLayouts($this->url . 'index');
    }

    public function updateInfo($uuid = 0)
    {
        echo json_encode($this->getInfo($uuid));
    }

    private function getInfo($uuid = 0)
    {
        if ($uuid === 0) {
            $this->raspbery = $this->raspberries[0];
        } else {
            foreach ($this->raspberries as $key) {
                if (in_array($uuid, $key)) {
                    $this->raspbery = $key;
                    break;
                }
            }
        }
        $logs = $this->Main_model->select('raspberry_records', ['flow', 'temperature', 'count', 'isOpen', 'createdAt'], ['raspberry_uuid' => $this->raspbery['uuid']], 7, 'DESC', 'createdAt');
        $records = $this->getStatistics($this->raspbery['uuid']);
        $lastRecord = $this->Main_model->select('raspberry_records', ['flow', 'temperature', 'count', 'isOpen'], ['raspberry_uuid' => $this->raspbery['uuid']], 1, 'DESC', 'createdAt', 1);

        return [
            'logs' => $logs,
            'records' => $records,
            'lastRecord' => $lastRecord
        ];
    }

    private function getStatistics($raspUUID = 0)
    {

        $formatType1 = "cast(rs.createdAt as date)";
        $formatType2 = "cast(r.createdAt as date)";
        $records = $this->Main_model->get_query(
            'select (select MAX(count) from raspberry_records rs WHERE ' . $formatType1 . ' = ' . $formatType2 . ' and raspberry_uuid = "' . $raspUUID . '" GROUP BY ' . $formatType1 . ') as maxCount, createdAt from raspberry_records r where '
                . 'createdAt BETWEEN "' . date('Y-m-d', strtotime('-7 days')) . ' 00:00:00" and "' . date('Y-m-d') . ' 23:59:59"'
                . ' and raspberry_uuid = "' . $raspUUID . '" GROUP by ' . $formatType2 . ' ORDER BY createdAt DESC'
        );

        return $records;
    }
}
