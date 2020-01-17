<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (Session::get('user_logged_in') == true) {
            $this->view->renderDashboard('error/index');
        } else {
            $this->view->render('error/index');
        }
    }

}
