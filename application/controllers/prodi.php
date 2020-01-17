<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Prodi extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxOperator();
    }

    function index() {
        $prodi_model = $this->loadModel('prodi');
        $this->view->prodis = $prodi_model->getAllProdi();
        $this->view->renderDashboard('prodi/index');
    }
    
    function add() {
        $pro_model = $this->loadModel('prodi');
        
        $this->view->optKps = $pro_model->GetOptKps();
        $this->view->renderDashboard('prodi/add');
    }
    
    public function edit($pro_id) {
        if (isset($pro_id)) {
            $pro_model = $this->loadModel('prodi');
            $this->view->optKps = $pro_model->GetOptKps();
            $this->view->prodi = $pro_model->getProdiForEdit($pro_id);
            $this->view->renderDashboard('prodi/edit');
        } else {
            header('location: ' . URL . 'prodi');
        }
    }
    
    public function saveAdd() {

        // 1. Ambil Post
        $_pro_nama = htmlspecialchars($_POST['pro_nama']);
        $_pro_user = htmlspecialchars($_POST['pro_user']);
        $_aktif = htmlspecialchars($_POST['pro_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_insert = array(
            ':pro_nama' => $_pro_nama,
            ':pro_user' => $_pro_user,
            ':pro_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_pro_nama)) {
            $pro_model = $this->loadModel('prodi');
            $pro_model->getProdiForSave($data_insert);
        }
        header('location: ' . URL . 'prodi');
    }
    
    public function saveEdit($pro_id) {

        // 1. Ambil Post
        $_pro_nama = htmlspecialchars($_POST['pro_nama']);
        $_pro_user = htmlspecialchars($_POST['pro_user']);
        $_aktif = htmlspecialchars($_POST['pro_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_update = array(
            ':pro_nama' => $_pro_nama,
            ':pro_user' => $_pro_user,
            ':pro_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_pro_nama)) {
            $pro_model = $this->loadModel('prodi');
            $pro_model->getProdiForUpdate($pro_id, $data_update);
        }
        header('location: ' . URL . 'prodi');
    }
    
    public function delete($pro_id) {
        if (isset($pro_id)) {
            $pro_model = $this->loadModel('prodi');
            $pro_model->getProdiForDelete($pro_id);
        }
        header('location: ' . URL . 'prodi');
    }

}

