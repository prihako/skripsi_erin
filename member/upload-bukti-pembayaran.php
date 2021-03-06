<?php
include "Connections/upload-foto.php";

date_default_timezone_set("Asia/Jakarta");

$lokasi_file;
$nama_file;
$nama_file_to_saved;
if (isset($_FILES['fupload'])){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file = $_FILES['fupload']['name'];
	$nama_file = preg_replace('/\s+/', '_', $nama_file);
	$nama_file_to_saved = date("dmY_h_i_s_A", time()) . "_" . $nama_file ;
}
?>
<?php

disable_cache(true);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_upload"])) && ($_POST["MM_upload"] == "form1")) {

    if (!empty($lokasi_file)) {
        UploadGaleri($nama_file_to_saved);
    } else {
        $nama_file = "no-image.jpg";
    }
    
    $insertSQL = sprintf("INSERT INTO document ("
            . "DOCUMENT_TYPE, "
            . "DOCUMENT_NAME, "
            . "ID_SISWA) "
            . "VALUES "
            . "(%s, %s, %s)",
            GetSQLValueString('7', "text"),
            GetSQLValueString($nama_file_to_saved, "text"),
            GetSQLValueString($_POST['id_siswa'], "text"));
    
    $resultInsertDocument = mysqli_query($alijtihad_db, $insertSQL) or die(mysqli_error($alijtihad_db));
    
    $updateSQLSiswa = sprintf("UPDATE siswa "
            . "SET STATUS = %s "
            . "WHERE ID_SISWA = %s",
             GetSQLValueString('2', "text"),
             GetSQLValueString($_POST['id_siswa'], "text"));
    
    $resultUpdateSiswa= mysqli_query($alijtihad_db, $updateSQLSiswa) or die(mysqli_error($alijtihad_db));
}

$colname_test = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_test = $_SESSION['MM_Username'];
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
$test = mysqli_query($alijtihad_db, $query_test) or die(mysql_error());
$row_test = mysqli_fetch_assoc($test);
$totalRows_test = mysqli_num_rows($test);

?>
<div class="isi">

    <div class="judul-web">Selamat Datang Saudara: <?php echo $row_test['nama_lengkap']; ?> Berikut Data Diri Anda
    </div>

    <form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
        <div class="main">
            <table width="100%" border="1">
                <tr>
                    <td width="19%" rowspan="7"><img src="foto/<?php echo $row_test['foto']; ?>" width="200"/></td>
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
                    <td>Upload Bukti Pembayaran</td>
                    <td colspan="2">

                        <?php
                        if ($row_test['status'] == 1) {
                            echo '<input type="file" name="fupload" id="foto" class="input-daftar" required><input type="submit"  value="Upload" class="btn">';
                        } else if ($row_test['status'] == 2) {
                            echo "Menunggu verifikasi bukti pembayaran dari ADMIN";
                        }else {
                            echo "Anda Sudah Mengupload Bukti Pembayaran";
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
