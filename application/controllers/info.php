<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Info extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxKps();
    }

    function index() {
        $info_model = $this->loadModel('info');
        $this->view->infos = $info_model->getAllInfo();
        $this->view->renderDashboard('info/index');
    }
    
    function add() {
        $info_model = $this->loadModel('info');
        $this->view->optProdi = $info_model->GetOptProdi();
        $this->view->renderDashboard('info/add');
    }
    
    public function edit($info_id) {
        if (isset($info_id)) {
            $info_model = $this->loadModel('info');
            $this->view->optProdi = $info_model->GetOptProdi();
            $this->view->info = $info_model->getInfoForEdit($info_id);
            $this->view->renderDashboard('info/edit');
        } else {
            header('location: ' . URL . 'info');
        }
    }
    
    public function saveAdd() {

        // 1. Ambil Post
        $_info_prodi_id = htmlspecialchars($_POST['info_prodi_id']);
        $_info_judul = htmlspecialchars($_POST['info_judul']);
        $_info_datem = htmlspecialchars($_POST['info_datem']);
        $_info_dates = htmlspecialchars($_POST['info_dates']);
        $_info_text = htmlspecialchars($_POST['info_text']);
        $_info_aktif = htmlspecialchars($_POST['info_aktif']);

        $f = $_info_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_insert = array(
            ':info_prodi_id' => $_info_prodi_id,
            ':info_judul' => $_info_judul,
            ':info_datem' => $_info_datem,
            ':info_dates' => $_info_dates,
            ':info_text' => $_info_text,
            ':info_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_info_prodi_id) && !empty($_info_judul) && !empty($_info_datem) && !empty($_info_dates)) {
            $info_model = $this->loadModel('info');
            if ($f == 'Y') {
                $info_model->getAllInfoNonAktif();
                $info_model->getInfoForSave($data_insert);
            } else {
                $info_model->getInfoForSave($data_insert);
            }
        }
        header('location: ' . URL . 'info');
    }
    
    public function saveEdit($info_id) {

        // 1. Ambil Post
        $_info_prodi_id = htmlspecialchars($_POST['info_prodi_id']);
        $_info_judul = htmlspecialchars($_POST['info_judul']);
        $_info_datem = htmlspecialchars($_POST['info_datem']);
        $_info_dates = htmlspecialchars($_POST['info_dates']);
        $_info_text = htmlspecialchars($_POST['info_text']);
        $_info_aktif = htmlspecialchars($_POST['info_aktif']);

        $f = $_info_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_update = array(
            ':info_prodi_id' => $_info_prodi_id,
            ':info_judul' => $_info_judul,
            ':info_datem' => $_info_datem,
            ':info_dates' => $_info_dates,
            ':info_text' => $_info_text,
            ':info_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_info_prodi_id) && !empty($_info_judul) && !empty($_info_datem) && !empty($_info_dates)) {
            $info_model = $this->loadModel('info');
            if ($f == 'Y') {
                $info_model->getAllInfoNonAktif();
                $info_model->getInfoForUpdate($info_id, $data_update);
            } else {
                $info_model->getInfoForUpdate($info_id, $data_update);
            }
        }
        header('location: ' . URL . 'info');
    }
    
    public function delete($info_id) {
        if (isset($info_id)) {
            //$de_info_id = $this->decode($info_id);
            $info_model = $this->loadModel('info');
            $row_aktif = $info_model->getInfoAktif($info_id);
            if ($row_aktif->info_aktif == 'N'){
                $info_model->getInfoForDelete($info_id);
            } else {
                $_SESSION["feedback_negative"][] = 'Info Aktif tidak bisa dihapus!';
            }
        }
        header('location: ' . URL . 'info');
    }
    
}

