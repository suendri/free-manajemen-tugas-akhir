<?php
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */
// Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 0);

/**
 * Configuration for: Base URL
 * This is the base url of our app. if you go live with your app, put your full domain name here.
 * if you are using a (different) port, then put this in here, like http://mydomain:8888/subfolder/
 * Note: The trailing slash is important!
 */
define('URL', 'http://localhost/gssimta/');

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('LIBS_PATH', 'application/libs/');
define('CONTROLLER_PATH', 'application/controllers/');
define('MODELS_PATH', 'application/models/');
define('VIEWS_PATH', 'application/views/');

// Folder Avatar
define('AVATAR_PATH', 'public/avatars/');
define('AVATAR_SIZE', 170);
define('AVATAR_JPEG_QUALITY', 85);
define('AVATAR_DEFAULT_IMAGE', 'nopicture.png');

// Files Folder
define('FILES_PATH', 'public/files/');

// Instansi
define("SISTEM_VERSI", "2.1");
define("SISTEM_NAMA", "SISTEM INFORMASI MANAJEMEN TUGAS AKHIR");
define("SISTEM_NAMA_", "Sistem Informasi Manajemen Tugas Akhir");
define("SISTEM_INSTANSI_NAMA", "AMIK ROYAL KISARAN");
define("SISTEM_INSTANSI_NAMA_LENGKAP", "Akademi Manajemen Informatika dan Komputer (AMIK) Royal Kisaran");
define("SISTEM_INSTANSI_NAMA_LENGKAP2", "Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK) Royal Kisaran");
define("SISTEM_INSTANSI_ALAMAT", "Jl. Imam Bonjol 179, Kisaran - Sumatera Utara");
//define("SISTEM_GAJI_TTD", "Suendri");

// Warning
define("FEEDBACK_UNKNOWN_ERROR", "Terjadi Kesalahan!");
define("FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET", "Akun anda tidak aktif");
define("FEEDBACK_PASSWORD_WRONG", "Password salah!");
define("FEEDBACK_USER_DOES_NOT_EXIST", "User tidak ditemukan!");
define("FEEDBACK_LOGIN_FAILED", "Gagal login.");
define("FEEDBACK_USERNAME_FIELD_EMPTY", "Username wajib diisi.");
define("FEEDBACK_PASSWORD_FIELD_EMPTY", "Password wajib diisi.");
define("FEEDBACK_REG_DATA_SUCCESS", "Pendaftaran berhasil! Silakan Login.");
define("FEEDBACK_REG_DATA_FAILED", "Pendaftaran Gagal! Silakan Ulangi.");

// Confirmation
define("FEEDBACK_SAVE_DATA_SUCCESS", "Data berhasil ditambahkan.");
define("FEEDBACK_SAVE_DATA_FAILED", "Tidak ada perobahan data dalam Database.");
define("FEEDBACK_UPDATE_DATA_SUCCESS", "Data berhasil diperbaharui.");
define("FEEDBACK_DELETE_DATA_SUCCESS", "Data berhasil dihapus.");
define("FEEDBACK_DELETE_DATA_FAILED", "Gagal menghapus data, Mohon cek kembali.");
define("FEEDBACK_PASSWORD_NOCHANGE", "Tidak ada perobahan Password.");
define("FEEDBACK_PASSWORD_CHANGE", "Terjadi perobahan Password.");

//avatar
define("FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE", "Folder public/avatars/ tidak ditemukan.");
define("FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED", "Proses Upload Avatar gagal.");
define("FEEDBACK_AVATAR_UPLOAD_TOO_BIG", "Ukuran Photo terlalu besar.");
define("FEEDBACK_AVATAR_UPLOAD_TOO_SMALL", "Ukuran Photo terlalu kecil.");
define("FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL", "Avatar berhasil diupload.");