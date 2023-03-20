<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account extends HM_Controller
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

        $this->url = 'account/';
    }

    public function index()
    {
        $this->raspberries = $this->Main_model->select('raspberries', 0, ['user_id' => $this->user['user']['id'], 'deleted' => NULL]);
        $this->getLayouts($this->url . 'index');
    }

    public function changeUserInfo()
    {
        $err = '';
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $err = '?err=Invalid email';
        if (!empty($_POST['email']) && empty($err)) {
            $user = $this->Main_model->get_query('select * from users where email = "' . $_POST['email'] . '" AND id != ' . $this->user['user']['id']);
            if (!empty($user)) $err = '?err=Email exists';
        }
        if (!isset($_POST['password']) || empty($_POST['password']) && empty($err)) $err = '?err=Password is required';
        if (md5($_POST['password']) !== $this->user['user']['password'] && empty($err)) $err = '?err=Wrong password';

        if (!empty($err)) {
            header('Location: ' . base_url() . $this->url . $err);
            exit;
        }

        [$updateData, $err] = arrayMustOnlyContain($_POST, ['email', 'fullName']);
        $this->Main_model->update('users', $updateData, ['id' => $this->user['user']['id']]);

        header('Location: ' . base_url() . $this->url . '?type=Changed successfully');
    }

    public function getRaspberryInfo($id)
    {
        if ($id != 0) {
            $this->raspberry = $this->Main_model->select('raspberries', 0, ['id' => $id, 'deleted' => NULL], 0, 0, 0, 1);
        }
        $this->load->view($this->url . 'ajax/raspberryInfo');
    }

    public function getRaspberryRecord($id)
    {
        $this->raspberry = $this->Main_model->select('raspberries', 0, ['id' => $id, 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($this->raspberry)) return '';

        $this->load->view($this->url . 'ajax/raspberryRecord');
    }

    public function addRaspberry()
    {
        $_POST['user_id'] = $this->user['user']['id'];
        [$insertData, $err] = arrayMustOnlyContain($_POST, ['name', 'uuid', 'user_id'], 1);
        if ($err) {
            header('Location: ' . base_url() . $this->url . '?err=' . $err);
            exit;
        }

        $raspberry = $this->Main_model->get_query('select id from raspberries where uuid = "' . $insertData['uuid'] . '"');
        if (!empty($raspberry)) {
            header('Location: ' . base_url() . $this->url . '?err=UUID exists');
            exit;
        }
        $this->Main_model->insert('raspberries', $insertData);
        header('Location: ' . base_url() . $this->url . '?type=Added successfully');
    }

    public function addRasbperryRecord($id)
    {
        $_POST['raspberry_uuid'] = $id;
        [$insertData, $err] = arrayMustOnlyContain($_POST, ['raspberry_uuid', 'count', 'flow', 'temperature', 'isOpen', 'createdAt'], 1);

        if ($err) {
            header('Location: ' . base_url() . $this->url . '?err=' . $err);
            exit;
        }

        $this->Main_model->insert('raspberry_records', $insertData);
        header('Location: ' . base_url() . $this->url . '?type=Added successfully');
    }

    public function editRasbperry($id)
    {
        $_POST['id'] = $id;
        $raspberry = $this->Main_model->select('raspberries', 0, ['id' => $id, 'user_id' => $this->user['user']['id'], 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($raspberry)) {
            header('Location: ' . base_url() . $this->url . '?err=Access denied');
            exit;
        }

        [$updateData, $err] = arrayMustOnlyContain($_POST, ['id', 'name', 'uuid'], 1);
        if ($err) {
            header('Location: ' . base_url() . $this->url . '?err=' . $err);
            exit;
        };

        $raspberry = $this->Main_model->get_query('select id from raspberries where uuid = "' . $updateData['uuid'] . '" and id != ' . $id);
        if (!empty($raspberry)) {
            header('Location: ' . base_url() . $this->url . '?err=UUID exists');
            exit;
        }

        $this->Main_model->update('raspberries', $updateData, ['id' => $id]);
        header('Location: ' . base_url() . $this->url . '?type=Changed successfully');
    }

    public function deleteRasbperry($id)
    {
        $this->raspberry = $this->Main_model->select('raspberries', 0, ['id' => $id, 'user_id' => $this->user['user']['id'], 'deleted' => NULL], 0, 0, 0, 1);
        if (empty($this->raspberry)) {
            header('Location: ' . base_url() . $this->url . '?err=Access denied');
            exit;
        }

        $this->Main_model->update('raspberries', ['deleted' => 1], ['id' => $id]);
        header('Location: ' . base_url() . $this->url . '?type=Deleted successfully');
    }
}
