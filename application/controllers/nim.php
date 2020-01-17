<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Nim extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        Auth::maxOperator();
    }

    function index() {
            $pagelimit = 10;
            $pagerange = 5;
            $this->view->page = 1;
            $this->view->position = $pagelimit;
            $this->view->range = $pagerange;
            //Load Model
            $nim_model = $this->loadModel('nim');
            $this->view->nims = $nim_model->getAllNim(0, $pagelimit);
            $this->view->total = $nim_model->getAllNimCount();
            $this->view->renderDashboard('nim/index');
    }

    function page($startlimit) {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = $startlimit;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $position = ($startlimit - 1) * $pagelimit;
        //Load Model
        $nim_model = $this->loadModel('nim');
        $this->view->nims = $nim_model->getAllNim($position, $pagelimit);
        $this->view->total = $nim_model->getAllNimCount();
        $this->view->renderDashboard('nim/index');
    }

    function nimAdd() {
            $this->view->renderDashboard('nim/add');
    }

    function nimCari() {
        $nim_model = $this->loadModel('nim');
        $katakunci = htmlspecialchars($_POST['katakunci']);

        if ($katakunci == "") {
            $this->view->renderDashboard('nim/index');
        } else {
            $_SESSION['nimcari'] = $katakunci;
            $this->view->nims = $nim_model->getAllNimLike($katakunci);
            $this->view->renderDashboard('nim/cari');
        }
    }

    public function saveAdd() {
        // 1. Ambil Post
        $_nim = htmlspecialchars($_POST['nim_no']);

        // 2. Arraykan
        $data_insert = array(
            ':nim_no' => $_nim,
            ':nim_creator' => $_SESSION['user_name']
        );

        // 3. Proses ke Model
        if (!empty($_nim)) {
            $nim_model = $this->loadModel('nim');
            $nim_model->getNimForSave($data_insert);
        }
        header('location: ' . URL . 'nim');
    }

    public function delete($nim_id) {
        if ($_SESSION['user_account_type'] <= 2) {
            if (isset($nim_id)) {
                $nim_model = $this->loadModel('nim');
                $nim_model->getNimForDelete($nim_id);
            }
            header('location: ' . URL . 'nim');
        } else {
            header('location: ' . URL . 'dashboard');
        }
    }

}
