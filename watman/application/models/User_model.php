<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model
{
    function login_user()
    {
        if (!isset($_SESSION['user_access'])) {
            return FALSE;
        } else {
            $CI = &get_instance();
            $CI->load->model('Main_model');

            $info['user'] = $CI->Main_model->Select('users', FALSE, array('uid' => $_SESSION['user_access'], 'deleted' => NULL), FALSE, FALSE);
            if (!empty($info['user'])) {
                $info['login'] = 'OK';
                $info['user'] = $info['user'][0];
            } else {
                $info['login'] = "SOMETHING WENT WRONG";
                unset($_SESSION['user_access']);
            }
            
            return $info;
        }
    }
}
