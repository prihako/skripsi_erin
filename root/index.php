<?php
require_once('../Connections/database_db.php');
include "cek-session.php";
require_once('../Connections/log_to_file.php');
require_once('../Connections/disable_cache.php');
?>

<?php
switch (isset($_GET['page']) ? $_GET['page'] : null) {
    default:
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }

        break;
    case"siswa":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/index.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"tambah-siswa":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/create.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"sortir-siswa":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/sortir.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"sortir":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/tt.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"edit-siswa":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/update.php";
            include"tema/footer.php";
            break;
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
    case"hapus-siswa":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/delete.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"admin":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"admin/index.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"tambah-admin":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"admin/create.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"edit-admin":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"admin/update.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"hapus-admin":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"admin/delete.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;

    case"pengumuman":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"pengumuman/index.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"tambah-pengumuman":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"pengumuman/create.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"edit-pengumuman":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"pengumuman/update.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"hapus-pengumuman":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"pengumuman/delete.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case "verifikasi-pemb":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/verifikasi-pemb.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case "verifikasi-berkas":
        if (isset($_SESSION['MM_Username'])) {
            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"siswa/verifikasi-berkas.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"mata-pelajaran":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"mata_pelajaran/index.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"tambah-mata-pelajaran":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"mata_pelajaran/create.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"edit-mata-pelajaran":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"mata_pelajaran/update.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"hapus-mata-pelajaran":
        if (isset($_SESSION['MM_Username'])) {

            include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"mata_pelajaran/delete.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
	case "input-nilai":
        if (isset($_SESSION['MM_Username'])) {
			include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"nilai/index.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
		case "create-nilai":
        if (isset($_SESSION['MM_Username'])) {
			include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"nilai/create_nilai.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
		case "view-nilai":
        if (isset($_SESSION['MM_Username'])) {
			include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"nilai/view_nilai.php";
            include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
	 case "cetak-pendaftaran":
        if (isset($_SESSION['MM_Username'])) {
			include"tema/head.php";
            include"tema/logo.php";
            include"tema/menu.php";
            include"tema/konten.php";
            include"cetak.php";
			include"tema/footer.php";
        } else {
            echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
        }
        break;
    case"login":
        include"tema/head.php";
        include"tema/logo.php";
        ?>
        <!--BAGIAN ISI-->
        <div class="login">

            <div class="judul-web">
                LOGIN SYSTEM
            </div>
            <!--BAGIAN MAIN-->
            <div class="main">
                <?php
                include"login.php";
                include"tema/footer.php";
                break;

            case"waktutes":
                if (isset($_SESSION['MM_Username'])) {

                    include"tema/head.php";
                    include"tema/logo.php";
                    include"tema/menu.php";
                    include"tema/konten.php";
                    include"waktutes/index.php";
                    include"tema/footer.php";
                } else {
                    echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
                }
                break;

            case"tambahwaktutes":
                if (isset($_SESSION['MM_Username'])) {

                    include"tema/head.php";
                    include"tema/logo.php";
                    include"tema/menu.php";
                    include"tema/konten.php";
                    include"waktutes/create.php";
                    include"tema/footer.php";
                } else {
                    echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
                }
                break;

            case"editwaktutes":
                if (isset($_SESSION['MM_Username'])) {

                    include"tema/head.php";
                    include"tema/logo.php";
                    include"tema/menu.php";
                    include"tema/konten.php";
                    include"waktutes/edit.php";
                    include"tema/footer.php";
                } else {
                    echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
                }
                break;

            case"hapuswaktutes":
                if (isset($_SESSION['MM_Username'])) {

                    include"tema/head.php";
                    include"tema/logo.php";
                    include"tema/menu.php";
                    include"tema/konten.php";
                    include"waktutes/delete.php";
                    include"tema/footer.php";
                } else {
                    echo" Anda Belum login <a href='index.php?page=login'>Klik Disini </a>";
                }
                break;
        }
        ?>