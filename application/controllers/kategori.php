<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Kategori extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxOperator();
    }

    function index() {
        $kategori_model = $this->loadModel('kategori');
        $this->view->kategoris = $kategori_model->getAllKategori();
        $this->view->renderDashboard('kategori/index');
    }
    
    function add() {
        $this->view->renderDashboard('kategori/add');
    }
    
    public function edit($kat_id) {
        if (isset($kat_id)) {
            $kat_model = $this->loadModel('kategori');
            $this->view->katdi = $kat_model->getKategoriForEdit($kat_id);
            $this->view->renderDashboard('kategori/edit');
        } else {
            header('location: ' . URL . 'kategori');
        }
    }
    
    public function saveAdd() {

        // 1. Ambil Post
        $_kat_nama = htmlspecialchars($_POST['kat_nama']);
        $_aktif = htmlspecialchars($_POST['kat_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_insert = array(
            ':kat_nama' => $_kat_nama,
            ':kat_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_kat_nama)) {
            $kat_model = $this->loadModel('kategori');
            $kat_model->getKategoriForSave($data_insert);
        }
        header('location: ' . URL . 'kategori');
    }
    
    public function saveEdit($kat_id) {

        // 1. Ambil Post
        $_kat_nama = htmlspecialchars($_POST['kat_nama']);
        $_aktif = htmlspecialchars($_POST['kat_aktif']);

        $f = $_aktif == 'Y' ? 'Y' : 'N';

        // 2. Arraykan
        $data_update = array(
            ':kat_nama' => $_kat_nama,
            ':kat_aktif' => $f
        );

        // 3. Proses ke Model
        if (!empty($_kat_nama)) {
            $kat_model = $this->loadModel('kategori');
            $kat_model->getKategoriForUpdate($kat_id, $data_update);
        }
        header('location: ' . URL . 'kategori');
    }
    
    public function delete($kat_id) {
        if (isset($kat_id)) {
            $kat_model = $this->loadModel('kategori');
            $kat_model->getKategoriForDelete($kat_id);
        }
        header('location: ' . URL . 'kategori');
    }
    
}

