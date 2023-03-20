<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends HM_Controller
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

        $this->url = 'settings/';
    }

    public function index()
    {
        $this->userSettings = $this->Main_model->select('settings', 0, ['user_id' => $this->user['user']['id']], 0, 0, 0, 1);
        $this->raspberries = $this->Main_model->select('raspberries', ['uuid'], ['user_id' => $this->user['user']['id'], 'deleted' => NULL]);
        $this->getLayouts($this->url.'index');
    }

    public function changeSettings() {
        [$editData] = arrayMustOnlyContain($_POST, ['startCount', 'warningTime', 'turnOfWaterTime', 'closeValveTempEx', 'closeValveTempDropsBelow', 'closeValvePressEx', 'closeValvePressDropsBelow', 'mode', 'emailWarningOff', 'emailTempAlertOn', 'emailPressAlertOn', 'smsWarningOff', 'smsTempAlertOn', 'smsPressAlertOn']);
        $this->Main_model->update('settings', $editData, ['user_id' => $this->user['user']['id']],);
        header('Location: ' . base_url() . $this->url . '?type=Changed Successfully');
    }
}
