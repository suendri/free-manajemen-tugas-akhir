<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Laporan extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();   
        Auth::maxKps();
    }
    
    function index() {
        $this->view->renderDashboard('laporan/index');
    }  
    
    public function terimaAll() {

        $awal = htmlspecialchars($_POST['tgl_awal']);
        $akhir = htmlspecialchars($_POST['tgl_akhir']);

        $data_cari = array(
            ':tgl_awal' => $awal,
            ':tgl_akhir' => $akhir
        );

        if (!empty($awal) AND ! empty($akhir)) {

            $_SESSION['tgl_awal'] = $awal;
            $_SESSION['tgl_akhir'] = $akhir;

            $laporan_model = $this->loadModel('laporan');
            $this->view->laporans = $laporan_model->getAllTerima($data_cari);
            $this->view->renderDashboard('laporan/all_terima');
        } else {
            $this->view->renderDashboard('laporan/index');
        }
    }
    
    public function printTerima() {

        $data_cari = array(
            ':tgl_awal' => $_SESSION['tgl_awal'],
            ':tgl_akhir' => $_SESSION['tgl_akhir']
        );

        if (!empty($_SESSION['tgl_awal']) AND ! empty($_SESSION['tgl_akhir'])) {
            $laporan_model = $this->loadModel('laporan');
            $this->view->laporans = $laporan_model->getAllTerima($data_cari);
            $this->view->renderPrint('laporan/print_terima');
        } else {
            $this->view->renderDashboard('laporan/index');
        }
    }
}