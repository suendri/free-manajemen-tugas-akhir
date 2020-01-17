<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo SISTEM_NAMA; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistem Informasi Manajemen Tugas Akhir">
        <meta name="keywords" content="Sistem,Manajemen,Tugas,Akhir,TA">
        <meta name="author" content="Suendri">
        <link href="<?php echo URL; ?>public/images/favicon.png" rel="shortcut icon">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/bootstrap.datatable.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/datepicker.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/custome.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">

        <script src="<?php echo URL; ?>public/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.datatable.min.js"></script>
        <script src="<?php echo URL; ?>public/js/bootstrap.datatable.js"></script>
        <script src="<?php echo URL; ?>public/js/bootstrap.datepicker.js"></script>
        <script src="<?php echo URL; ?>public/tinymce/tinymce.min.js"></script>
        <script src="<?php echo URL; ?>public/js/bootstrap.validator.js"></script>
        <script src="<?php echo URL; ?>public/js/custom.js"></script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#dtb').dataTable();
            });
        </script>

    </head>
    <body <?php if (Session::get('user_logged_in') == false) { ?>id="body-full-img" <?php } ?> onload="startTime()">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo URL; ?>">gsSIMTA</a>
                </div>
                <?php if (Session::get('user_logged_in') == true): ?>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li <?php
                            if ($this->checkForActiveController($filename, "dashboard")) {
                                echo ' class="active" ';
                            }
                            ?>><a href="<?php echo URL; ?>">Home</a></li>
                            <li <?php
                            if ($this->checkForActiveController($filename, "repository")) {
                                echo ' class="active" ';
                            }
                            ?>><a href="<?php echo URL; ?>repository">Repository</a></li>
                                <?php if (Session::get('user_account_type') == 3): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li <?php
                                        if ($this->checkForActiveController($filename, "laporan")) {
                                            echo ' class="active" ';
                                        }
                                        ?>><a href="<?php echo URL; ?>laporan">Cetak Pengajuan</a></li>                                    
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if (Session::get('user_account_type') <= 2): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li <?php
                                        if ($this->checkForActiveController($filename, "nim")) {
                                            echo ' class="active" ';
                                        }
                                        ?>><a href="<?php echo URL; ?>nim">Nomor Induk</a></li>
                                        <li <?php
                                        if ($this->checkForActiveController($filename, "prodi")) {
                                            echo ' class="active" ';
                                        }
                                        ?>><a href="<?php echo URL; ?>prodi">Program Studi</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Repository</li>
                                        <li <?php
                                        if ($this->checkForActiveController($filename, "kategori")) {
                                            echo ' class="active" ';
                                        }
                                        ?>><a href="<?php echo URL; ?>kategori">Kategori</a></li>                                   
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (Session::get('user_account_type') == 1): ?>
                                <li <?php
                                if ($this->checkForActiveController($filename, "user")) {
                                    echo ' class="active" ';
                                }
                                ?>><a href="<?php echo URL; ?>user">User</a></li>
                                <?php endif; ?>

                            <li><a href="<?php echo URL; ?>index/logout">Logout</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><div class="navbar-right-info desktop-only">Hari ini : <b><?php echo $this->TanggalIndonesia(date("Y-m-d")); ?>, <span id="jam"></span></b></div></li>        
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if (Session::get('user_logged_in') == true) { ?>
            <div class="clear-dash"></div>
        <?php } else { ?>
            <div class="clear-top"></div>
        <?php } ?>
        <div class="container">
