<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends HM_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Main_model');
        $this->url = "auth/";

        if (!empty($_SESSION['user_access']) && $this->router->fetch_method() !== 'logout') {
            header('Location:' . base_url());
            exit;
        }
    }

    public function index()
    {
        header('Location: ' . base_url() . 'auth/login');
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function loginRun()
    {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $this->user = $this->Main_model->Select('users', FALSE, array('email' => $_POST['email'], 'password' => md5($_POST['password'])), FALSE, FALSE, FALSE, TRUE);

            if (!empty($this->user)) {
                $_SESSION['user_access'] = $this->user['uid'];
                header('Location: ' . base_url());
                exit;
            }

            header('Location: ' . base_url() . 'auth/login');
            exit;
        }

        header('Location: ' . base_url() . 'auth/login');
    }

    public function registration()
    {
        $this->load->view('auth/registration');
    }

    public function registrationRun()
    {
        $errorText = '';

        $user = $this->Main_model->select('users', FALSE, ['email' => $_POST['email']]);

        if (!empty($user)) $errorText = '?err=Email exists';
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errorText = '?err=Invalid email';

        if ($errorText) {
            header('Location: ' . base_url() . 'auth/registration' . $errorText);
            exit;
        }

        $_POST['password'] = md5($_POST['password']);
        if (!isset($_POST['type']) || ($_POST['type'] != 0 && $_POST['type'] != 1)) $_POST['type'] = 0;

        [$updateData, $err] = arrayMustOnlyContain($_POST, ['email', 'fullName', 'password', 'type']);

        $userId = $this->Main_model->insert('users', $updateData);
        $uid = uniqid($userId, true);
        $md5Uid = md5($uid);
        
        $this->Main_model->update('users', ['uid' => $md5Uid], ['id' => $userId]);
        $this->Main_model->insert('settings', ['user_id' => $userId]);

        $_SESSION['user_access'] = $md5Uid;
        header('Location: ' . base_url());
    }

    public function logout()
    {
        unset($_SESSION['user_access']);
        header('Location: ' . base_url() . 'auth/login');
        die();
    }
}
