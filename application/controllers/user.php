<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class User extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxOperator();
    }

    public function index() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $_SESSION['usercari'] = NULL;
        
        $user_model = $this->loadModel('user');
        $this->view->users = $user_model->getAllUser(0, $pagelimit);
        $this->view->total = $user_model->getAllUserCount();
        $this->view->renderDashboard('user/index');
    }
    
    function page($startlimit) {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = $startlimit;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $position = ($startlimit - 1) * $pagelimit;
        
        // Load Model
        $user_model = $this->loadModel('user');
        // Jika ada $_SESSION['usercari']
        if (isset($_SESSION['usercari'])) {
            $this->view->users = $user_model->getAllUserLike($_SESSION['usercari'], $position, $pagelimit);
            $this->view->total = $user_model->getAllUserLikeCount($_SESSION['usercari']); 
        } else {
            $this->view->users = $user_model->getAllUser($position, $pagelimit);
            $this->view->total = $user_model->getAllUserCount(); 
        }
        
        $this->view->renderDashboard('user/index');
    }

    function userCari() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        // POST katakunci
        $katakunci = htmlspecialchars($_POST['katakunci']);
        // Load Model
        $user_model = $this->loadModel('user');

        if ($katakunci == "") {
            header('location: ' . URL . 'user/index');
        } else {
            $_SESSION['usercari'] = $katakunci;
            $this->view->users = $user_model->getAllUserLike($katakunci, 0, $pagelimit);
            $this->view->total = $user_model->getAllUserLikeCount($katakunci);
            $this->view->renderDashboard('user/cari');
        }
    }

    public function add() {
        $this->view->renderDashboard('user/add');
    }

    public function edit($user_id) {
        if (isset($user_id)) {
            $user_model = $this->loadModel('user');
            $this->view->user = $user_model->getUserForEdit($user_id);
            $this->view->renderDashboard('user/edit');
        } else {
            header('location: ' . URL . 'user');
        }
    }

    public function saveAdd() {

        // 1. Ambil Post
        $_username = htmlspecialchars($_POST['user_name']);
        $_password = htmlspecialchars($_POST['user_password']);
        $_email = htmlspecialchars($_POST['user_email']);
        $_nama = htmlspecialchars($_POST['user_nama_lengkap']);
        $_level = htmlspecialchars($_POST['user_level']);
        $_aktif = htmlspecialchars($_POST['user_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // Encrypt Password
        $pass_verify = password_hash($_password, PASSWORD_DEFAULT);

        // 2. Arraykan
        $data_insert = array(
            ':user_name' => $_username,
            ':user_password_hash' => $pass_verify,
            ':user_email' => $_email,
            ':user_account_type' => $_level,
            ':user_active' => $f,
            ':user_nama_lengkap' => $_nama
        );

        // 3. Proses ke Model
        if (!empty($_username)) {
            $user_model = $this->loadModel('user');
            $user_model->getUserForSave($data_insert);
        }
        header('location: ' . URL . 'user');
    }

    public function saveEdit($user_id) {

        // 1. Ambil Post
        $_password = htmlspecialchars($_POST['user_password']);
        $_email = htmlspecialchars($_POST['user_email']);
        $_nama = htmlspecialchars($_POST['user_nama_lengkap']);
        $_level = htmlspecialchars($_POST['user_level']);
        $_aktif = htmlspecialchars($_POST['user_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // Encrypt Password
        $pass_verify = password_hash($_password, PASSWORD_DEFAULT);

        // 2. Arraykan
        $data_update_all = array(
            ':user_password_hash' => $pass_verify,
            ':user_email' => $_email,
            ':user_account_type' => $_level,
            ':user_active' => $f,
            ':user_nama_lengkap' => $_nama
        );

        $data_noupdate_pass = array(
            ':user_email' => $_email,
            ':user_account_type' => $_level,
            ':user_active' => $f,
            ':user_nama_lengkap' => $_nama
        );

        // 3. Proses ke Model
        if (!empty($user_id) && !empty($_nama)) {
            $user_model = $this->loadModel('user');
            if ($_password <> "") {
                $user_model->getUserForUpdate($user_id, $data_update_all, "user_password_hash = :user_password_hash,");
                $_SESSION["feedback_positive"][] = FEEDBACK_PASSWORD_CHANGE;
            } else {
                $user_model->getUserForUpdate($user_id, $data_noupdate_pass, "");
                $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_NOCHANGE;
            }
        }
        header('location: ' . URL . 'user');
    }

    public function delete($user_id) {
        if (isset($user_id)) {
            $user_model = $this->loadModel('user');
            $user_model->getUserForDelete($user_id);
        }
        header('location: ' . URL . 'user');
    }

}
