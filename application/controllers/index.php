<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (Session::get('user_logged_in') == false) {
            // Perbaikan versi 2.1
            // render_
            $this->view->render_('index/index');
        } else {
            $gt_model = $this->loadModel('dashboard');
            $this->view->aju = $gt_model->getTotalPengajuanMasuk();
            $this->view->rts = $gt_model->getRepoTerakhir();
            $this->view->renderDashboard('dashboard/index');
        }
    }

    function login() {
        // Perbaikan versi 2.1
        // Perintah Login pindah dari Model ke Controller
        if (isset($_POST['prclogin'])) {
            $user = htmlspecialchars($_POST['user_name']);
            $pass = htmlspecialchars($_POST['user_password']);

            if (!isset($user) OR empty($user)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
                header('location: ' . URL . 'index/index');
            }
            if (!isset($pass) OR empty($pass)) {
                $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
                header('location: ' . URL . 'index/index');
            }

            $login_model = $this->loadModel('Login');
            $login_successful_count = $login_model->loginCount($user);
            $login_successful_row = $login_model->loginRow($user);

            if ($login_successful_count == 1) {

                if (password_verify($pass, $login_successful_row->user_password_hash)) {

                    // login process, write the user data into session
                    Session::init();
                    Session::set('user_logged_in', true);
                    Session::set('user_id', $login_successful_row->user_id);
                    Session::set('user_name', $login_successful_row->user_name);
                    Session::set('user_account_type', $login_successful_row->user_account_type);
                    Session::set('user_nama_lengkap', $login_successful_row->user_nama_lengkap);

                    // Avatar
                    Session::set('user_avatar', $login_model->getUserAvatarFilePath());

                    header('location: ' . URL . 'dashboard/index');
                } else {
                    $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FAILED;
                    header('location: ' . URL . 'index/index');
                }
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FAILED;
                header('location: ' . URL . 'index/index');
            }
        }
        header('location: ' . URL . 'index/index');
    }

    function daftar() {
        // Perbaikan versi 2.1
        // render_
        $this->view->render_('index/registrasi');
    }

    function getNim() {
        $user_nim = htmlspecialchars($_POST['user_nim']);

        $reg_model = $this->loadModel('Login');
        $this->view->nim = $reg_model->getNimData($user_nim);
        $this->view->renderAjax('index/ajax');
    }

    function saveAdd() {

        $_username = htmlspecialchars($_POST['user_nim']);
        $_password = htmlspecialchars($_POST['user_password']);
        $_email = htmlspecialchars($_POST['user_email']);
        $_nama = htmlspecialchars($_POST['user_nama']);

        // Encrypt Password
        $pass_verify = password_hash($_password, PASSWORD_DEFAULT);

        // 2. Arraykan
        $data_insert = array(
            ':user_name' => $_username,
            ':user_password_hash' => $pass_verify,
            ':user_email' => $_email,
            ':user_nama_lengkap' => $_nama
        );

        if (!empty($_username) && !empty($_password) && !empty($_nama)) {
            $daftar_model = $this->loadModel('Login');
            $daftar_model->getRegForSave($data_insert, $_username);
        }
        header('location: ' . URL);
    }

    function logout() {
        // delete the session
        Session::destroy();
        header('location: ' . URL);
    }

    function isUserLoggedIn() {
        return Session::get('user_logged_in');
    }

}
