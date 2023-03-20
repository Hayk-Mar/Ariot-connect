<?php

defined('BASEPATH') or exit('No direct script access allowed');

class API extends HM_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function addRecord() {
        $err = ['hasError' => true];
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $err['message'] = 'Wrong request method';
            $err['code'] = 405;
            http_response_code(405);
            echo json_encode($err);
            exit;
        }
        [$insertData, $errData] = arrayMustOnlyContain($_POST, ['raspberry_uuid', 'count', 'flow', 'temperature', 'createdAt', 'isOpen'], 1);
        if ($errData) {
            $err['message'] = $errData;
            $err['code'] = 400;
            http_response_code(400);
            echo json_encode($err);
            exit;
        }

        $raspberry = $this->Main_model->select('raspberries', 0, ['uuid' => $insertData['raspberry_uuid'], 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($raspberry)) {
            $err['message'] = 'Raspberry not found';
            $err['code'] = 400;
            http_response_code(400);
            echo json_encode($err);
            exit;
        }

        $this->Main_model->insert('raspberry_records', $insertData);
        http_response_code(201);
        echo json_encode(['hasError' => false, 'code' => 201, 'message' => 'Completed succesfully']);
    }

    public function getSettings($raspberry_uuid) {
        $err = ['hasError' => true];
        if($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $err['message'] = 'Wrong request method';
            $err['code'] = 405;
            http_response_code(405);
            echo json_encode($err);
            exit;
        }

        $raspberry = $this->Main_model->select('raspberries', 0, ['uuid' => $raspberry_uuid, 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($raspberry)) {
            $err['message'] = 'Raspberry not found';
            $err['code'] = 400;
            http_response_code(400);
            echo json_encode($err);
            exit;
        }

        $user = $this->Main_model->select('users', 0, ['id' => $raspberry['user_id'], 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($user)) {
            $err['message'] = 'This rasberry belongs to user who is not in our database';
            $err['code'] = 400;
            http_response_code(400);
            echo json_encode($err);
            exit;
        }

        $settings = $this->Main_model->select('settings', 0, ['user_id' => $raspberry['user_id']], 0, 0, 0, 1);
        if (empty($settings)) {
            $err['message'] = 'Settings not found';
            $err['code'] = 400;
            http_response_code(400);
            echo json_encode($err);
            exit;
        }

        http_response_code(200);
        echo json_encode(['hasError' => false, 'code' => 200, 'data' => [
            "turnOfWaterTime" => $settings['turnOfWaterTime'],
            "closeValveTempEx" => $settings['closeValveTempEx'],
            "closeValveTempDropsBelow" => $settings['closeValveTempDropsBelow'],
            "mode" => $settings['mode'],
        ]]);
    }
}