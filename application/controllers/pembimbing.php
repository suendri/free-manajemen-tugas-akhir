<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Pembimbing extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxKps();
    }

    function index() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        //--
        $aju_model = $this->loadModel('pembimbing');
        $this->view->ajus = $aju_model->getAllPembimbing(0, $pagelimit);
        $this->view->total = $aju_model->getAllTerimaCount();
        $this->view->renderDashboard('pembimbing/index');
    }
    
    function page($startlimit) {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = $startlimit;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $position = ($startlimit - 1) * $pagelimit;
        //Load Model
        $aju_model = $this->loadModel('pembimbing');

        // Jika ada $_SESSION['repocari']
        if (isset($_SESSION['pmmbcari'])) {
            $this->view->repos = $aju_model->getAllTerimaLike($_SESSION['pmmbcari'], $position, $pagelimit);
            $this->view->total = $aju_model->getAllTerimaLikeCount($_SESSION['pmmbcari']); 
        } else {
            $this->view->ajus = $aju_model->getAllPembimbing($position, $pagelimit);
            $this->view->total = $aju_model->getAllTerimaCount();
        }
        $this->view->renderDashboard('pembimbing/index');
    }
    
    function cari() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        
        $aju_model = $this->loadModel('pembimbing');
        $katakunci = htmlspecialchars($_POST['katakunci']);

        if ($katakunci == "") {
            $this->view->renderDashboard('pembimbing/index');
        } else {
            $_SESSION['pmmbcari'] = $katakunci;
            $this->view->ajus = $aju_model->getAllTerimaLike($katakunci, 0, $pagelimit);
            $this->view->total = $aju_model->getAllTerimaLikeCount($katakunci); 
            $this->view->renderDashboard('pembimbing/cari');
        }
    }

    public function edit($aju_id) {
        if (isset($aju_id)) {
            $aju_model = $this->loadModel('pembimbing');
            $this->view->pmmb = $aju_model->getPembimbingForEdit($aju_id);
            $this->view->renderDashboard('pembimbing/edit');
        } else {
            header('location: ' . URL . 'pembimbing');
        }
    }

    public function saveEdit($aju_id) {

        // 1. Ambil Post
        $_pmmb1 = htmlspecialchars($_POST['pmmb1']);
        $_pmmb2 = htmlspecialchars($_POST['pmmb2']);

        // 2. Arraykan
        $data_update = array(
            ':aju_pmmb1' => $_pmmb1,
            ':aju_pmmb2' => $_pmmb2
        );

        // 3. Proses ke Model
        $aju_model = $this->loadModel('pembimbing');
        $aju_model->getPembimbingForUpdate($aju_id, $data_update);

        header('location: ' . URL . 'pembimbing');
    }

}
