<?php
include "Connections/upload-foto.php";

date_default_timezone_set("Asia/Jakarta");

?>
<?php

disable_cache(true);

function is_already_upload_document($username, $documentType){
    global $alijtihad_db;
    $queryIsAlreadyUploadDoc = sprintf("select s.username "
        . "from siswa s left join document d on s.id_siswa = d.id_siswa "
        . "where s.username = %s and d.document_type = %s",
        GetSQLValueString($username, "text"),
        GetSQLValueString($documentType, "text"));
    $resultSelect = mysqli_query($alijtihad_db, $queryIsAlreadyUploadDoc);
    $totalRow = mysqli_num_rows($resultSelect);
    
    return $totalRow;
}

function insert_into_document($document_type, $file_name, $id_siswa){
    global $alijtihad_db;
    
    $insertSQL = sprintf("INSERT INTO document ("
                . "DOCUMENT_TYPE, "
                . "DOCUMENT_NAME, "
                . "ID_SISWA) "
                . "VALUES "
                . "(%s, %s, %s)",
                GetSQLValueString($document_type, "text"),
                GetSQLValueString($file_name, "text"),
                GetSQLValueString($id_siswa, "int"));

    mysqli_query($alijtihad_db, $insertSQL);
}

$colname_test = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_test = $_SESSION['MM_Username'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_upload"])) && ($_POST["MM_upload"] == "form1")) {

    if (isset($_POST['btnUploadIjazah'])) {
        $lokasi_file = $_FILES['ijazah']['tmp_name'];
        $nama_file = $_FILES['ijazah']['name'];
		$nama_file = preg_replace('/\s+/', '_', $nama_file);
        $nama_file_to_saved = date("dmY_h_i_s_A", mktime()) . "_" . $nama_file ;
       
        if (!empty($lokasi_file)) {
            UploadGaleriV2($nama_file_to_saved, 'ijazah');
            insert_into_document('2', $nama_file_to_saved, $_POST['id_siswa']);
        } else {
            log_to_file_v2("file ijazah kosong", basename(__FILE__), __LINE__);
        }

    }
    
    if (isset($_POST['btnUploadSKHUN'])) {
        $lokasi_file = $_FILES['skhun']['tmp_name'];
        $nama_file = $_FILES['skhun']['name'];
		$nama_file = preg_replace('/\s+/', '_', $nama_file);
        $nama_file_to_saved = date("dmY_h_i_s_A", mktime()) . "_" . $nama_file ;
       
        if (!empty($lokasi_file)) {
            UploadGaleriV2($nama_file_to_saved, 'skhun');
            insert_into_document('3', $nama_file_to_saved, $_POST['id_siswa']);
        } else {
            log_to_file_v2("file SKHUN kosong", basename(__FILE__), __LINE__);
        }

    }
    
    if (isset($_POST['btnUploadAkta'])) {
        $lokasi_file = $_FILES['akta_kel']['tmp_name'];
        $nama_file = $_FILES['akta_kel']['name'];
		$nama_file = preg_replace('/\s+/', '_', $nama_file);
        $nama_file_to_saved = date("dmY_h_i_s_A", mktime()) . "_" . $nama_file ;
       
        if (!empty($lokasi_file)) {
            UploadGaleriV2($nama_file_to_saved, 'akta_kel');
            insert_into_document('4', $nama_file_to_saved, $_POST['id_siswa']);
        } else {
            log_to_file_v2("file Akta kosong", basename(__FILE__), __LINE__);
        }

    }
    
    if (isset($_POST['btnKtpBapak'])) {
        $lokasi_file = $_FILES['ktp_bapak']['tmp_name'];
        $nama_file = $_FILES['ktp_bapak']['name'];
		$nama_file = preg_replace('/\s+/', '_', $nama_file);
        $nama_file_to_saved = date("dmY_h_i_s_A", mktime()) . "_" . $nama_file ;
       
        if (!empty($lokasi_file)) {
            UploadGaleriV2($nama_file_to_saved, 'ktp_bapak');
            insert_into_document('5', $nama_file_to_saved, $_POST['id_siswa']);
        } else {
            log_to_file_v2("file KTP Bapak kosong", basename(__FILE__), __LINE__);
        }

    }
    
    if (isset($_POST['btnKtpIbu'])) {
        $lokasi_file = $_FILES['ktp_ibu']['tmp_name'];
        $nama_file = $_FILES['ktp_ibu']['name'];
		$nama_file = preg_replace('/\s+/', '_', $nama_file);
        $nama_file_to_saved = date("dmY_h_i_s_A", mktime()) . "_" . $nama_file ;
       
        if (!empty($lokasi_file)) {
            UploadGaleriV2($nama_file_to_saved, 'ktp_ibu');
            insert_into_document('6', $nama_file_to_saved, $_POST['id_siswa']);
        } else {
            log_to_file_v2("file KTP Ibu kosong", basename(__FILE__), __LINE__);
        }

    }
    
    $totalRowDocSQL = sprintf("select s.username "
            . "from siswa s left join document d "
            . "on s.id_siswa = d.id_siswa "
            . "where d.document_type in ('2', '3', '4', '5', '6') "
            . "and s.username = %s",
            GetSQLValueString($colname_test, "text"));

    $totalRowDocSQLResult= mysqli_query($alijtihad_db, $totalRowDocSQL);
    
    $totalRowDoc = mysqli_num_rows($totalRowDocSQLResult);
    
    if($totalRowDoc >= 5){
        $updateSQLSiswa = sprintf("UPDATE siswa "
            . "SET STATUS = %s "
            . "WHERE ID_SISWA = %s",
             GetSQLValueString('4', "text"),
             GetSQLValueString($_POST['id_siswa'], "text"));
    
        $resultUpdateSiswa= mysqli_query($alijtihad_db, $updateSQLSiswa);
    }else{
        log_to_file_v2("total doc already uploaded " . $totalRowDoc, basename(__FILE__), __LINE__);
    }
}

$query_test = sprintf("SELECT "
        . "s.id_siswa, "
        . "s.username, "
        . "s.foto, "
        . "s.nama_lengkap, "
        . "ot1.nama as nama_bapak, "
        . "ot2.nama as nama_ibu, "
        . "param_jen_kel.param_name as jenis_kelamin, "
        . "param_agama.param_name as agama, "
        . "p.param_value status, "
        . "p.param_name status_name "
        . "FROM siswa s left join parameter p "
        . "on s.status = p.param_value and p.column_name = 'status' "
        . "left join parameter param_jen_kel "
        . "on s.jenis_kelamin = param_jen_kel.param_value and param_jen_kel.column_name ='jenis_kelamin' "
        . "left join parameter param_agama "
        . "on s.agama = param_agama.param_value and param_agama.column_name = 'agama' "
        . "left join orang_tua ot1 "
        . "on s.id_siswa = ot1.id_siswa and ot1.tipe_orang_tua = '1' "
        . "left join orang_tua ot2 "
        . "on s.id_siswa = ot2.id_siswa and ot2.tipe_orang_tua = '2' "
        . "where s.username =%s ", GetSQLValueString($colname_test, "text"));
$test = mysqli_query($alijtihad_db, $query_test);
$row_test = mysqli_fetch_assoc($test);
$totalRows_test = mysqli_num_rows($test);

$is_already_upload_ijazah = is_already_upload_document($colname_test, '2');
$is_already_upload_skhun = is_already_upload_document($colname_test, '3');
$is_already_upload_akta = is_already_upload_document($colname_test, '4');
$is_already_upload_ktp_bapak = is_already_upload_document($colname_test, '5');
$is_already_upload_ktp_ibu = is_already_upload_document($colname_test, '6');

?>
<div class="isi">

    <div class="judul-web">Selamat Datang Saudara: <?php echo $row_test['nama_lengkap']; ?> Berikut Data Diri Anda
    </div>

    <form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
        <div class="main">
            <table width="100%" border="1">
                <tr>
                    <td width="19%" rowspan="6"><img src="foto/<?php echo $row_test['foto']; ?>" width="200"/></td>
                    <td width="19%">NISN</td>
                    <td><?php echo $row_test['username']; ?></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><?php echo $row_test['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td><?php echo $row_test['nama_bapak']; ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td><?php echo $row_test['nama_ibu']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?php echo $row_test['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td><?php echo $row_test['agama']; ?></td>
                </tr>
                <tr>
                    <td>Upload Ijazah/STTB</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] < 4 && $is_already_upload_ijazah < 1 ) {
                            echo '<input type="file" name="ijazah" id="ijazah" class="input-daftar">'
                            . '<input type="submit"  value="Upload" name="btnUploadIjazah" class="btn">';
                        } else {
                            echo "Anda Sudah Mengupload berkas";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Upload SKHUN</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] < 4 && $is_already_upload_skhun < 1) {
                            echo '<input type="file" name="skhun" id="skhun" class="input-daftar">'
                            . '<input type="submit"  value="Upload" name="btnUploadSKHUN" class="btn">';
                        } else {
                            echo "Anda Sudah Mengupload berkas";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Akta Kelahiran</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] < 4 && $is_already_upload_akta < 1) {
                            echo '<input type="file" name="akta_kel" id="akta_kel" class="input-daftar">'
                            . '<input type="submit"  value="Upload" name="btnUploadAkta" class="btn">';
                        } else {
                            echo "Anda Sudah Mengupload berkas";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Upload KTP Bapak</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] < 4 && $is_already_upload_ktp_bapak < 1) {
                            echo '<input type="file" name="ktp_bapak" id="ktp_bapak" class="input-daftar">'
                            . '<input type="submit"  value="Upload" name="btnKtpBapak" class="btn">';
                        } else {
                            echo "Anda Sudah Mengupload berkas";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Upload KTP Ibu</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] < 4 && $is_already_upload_ktp_ibu < 1) {
                            echo '<input type="file" name="ktp_ibu" id="ktp_ibu" class="input-daftar">'
                            . '<input type="submit"  value="Upload" name="btnKtpIbu" class="btn">';
                        } else {
                            echo "Anda Sudah Mengupload berkas";
                        }
                        ?>

                    </td>
                </tr>
            </table>

        </div>
        <input type="hidden" name="MM_upload" value="form1">
        <input type="hidden" name="id_siswa" value="<?php echo $row_test['id_siswa']; ?>">
    </form>

</div>
<?php
mysqli_free_result($test);
?>
