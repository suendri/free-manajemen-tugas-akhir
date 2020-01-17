<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class Dashboard extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }

    function index() {
        $gt_model = $this->loadModel('dashboard');
        $this->view->aju = $gt_model->getTotalPengajuanMasuk();
        $this->view->rts = $gt_model->getRepoTerakhir();
        $this->view->renderDashboard('dashboard/index');
    }

    function profil() {
        if (!empty($_SESSION['user_id'])) {
            $user_model = $this->loadModel('dashboard');
            $this->view->user = $user_model->getProfilForEdit($_SESSION['user_id']);
            $this->view->renderDashboard('dashboard/profil');
        } else {
            header('location: ' . URL . 'dashboard/index');
        }
    }

    public function saveProfil($user_id) {

        // 1. Ambil Post
        $_password = htmlspecialchars($_POST['user_password']);
        $_email = htmlspecialchars($_POST['user_email']);
        $_nama = htmlspecialchars($_POST['user_nama_lengkap']);

        // Encrypt Password
        $pass_verify = password_hash($_password, PASSWORD_DEFAULT);

        // 2. Arraykan
        $data_update_all = array(
            ':user_password_hash' => $pass_verify,
            ':user_email' => $_email,
            ':user_nama_lengkap' => $_nama
        );

        $data_noupdate_pass = array(
            ':user_email' => $_email,
            ':user_nama_lengkap' => $_nama
        );

        // 3. Proses ke Model
        if (!empty($user_id) && !empty($_nama)) {
            $user_model = $this->loadModel('dashboard');
            if ($_password <> "") {
                $user_model->getProfilForUpdate($user_id, $data_update_all, "user_password_hash = :user_password_hash,");
                $_SESSION["feedback_positive"][] = FEEDBACK_PASSWORD_CHANGE;
            } else {
                $user_model->getProfilForUpdate($user_id, $data_noupdate_pass, "");
                $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_NOCHANGE;
            }
        }

        header('location: ' . URL . 'dashboard/profil');
    }

    function avatar() {
        $this->view->renderDashboard('dashboard/avatar');
    }

    function saveAvatar() {
        $avatar_model = $this->loadModel('dashboard');
        $avatar_model->getPhotoForInsert();
        $this->view->renderDashboard('dashboard/avatar');
    }

}
