<?php

error_reporting(0);
require_once('Connections/database_db.php');
include('Connections/function.php');
require_once('Connections/log_to_file.php');
require_once('Connections/disable_cache.php');
?>
<?php

//halaman utama
switch (isset($_GET['page']) ? $_GET['page'] : null) {
    default:
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/isi.php");
        include("tema/include/kaki.php");
        break;
    case "panduan":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/panduan.php");
        include("tema/include/kaki.php");
        break;
    case "informasi":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/informasi.php");
        include("tema/include/kaki.php");
        break;
    case "data-pendaftar":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/data-pendaftar.php");
        include("tema/include/kaki.php");
        break;
	case "baru":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/barur.php");
        include("tema/include/kaki.php");
        break;
    case "pendaftaran":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/pendaftaran.php");
        include("tema/include/kaki.php");
        break;

    case "login":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("tema/include/login.php");
        include("tema/include/kaki.php");
        break;
    case "gagal":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        echo "Gagal Login";
        include("tema/include/kaki.php");
        break;
    case "berhasil":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        include("tema/include/menu.php");
        include("tema/include/berhasil.php");
        include("tema/include/kaki.php");
        break;
    case "username":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        include("tema/include/menu.php");
        include("tema/include/username.php");
        include("tema/include/kaki.php");
        break;
    case "siswa":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("member/index.php");
        include("tema/include/kaki.php");
        break;
    case "upload-pembayaran":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("member/upload-bukti-pembayaran.php");
        include("tema/include/kaki.php");
        break;
    case "upload-berkas":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("member/upload-berkas.php");
        include("tema/include/kaki.php");
        break;
    case "detail-siswa":
        include("tema/include/header.php");
        include("tema/include/logo.php");
        if (isset($_SESSION['MM_Username'])) {
            include("member/menu.php");
        } else {
            include("tema/include/menu.php");
        }
        include("member/detail-siswa.php");
        include("tema/include/kaki.php");
        break;
}
?>
