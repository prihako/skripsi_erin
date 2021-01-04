<?php
include "Connections/image_display_helper.php";

disable_cache(true);

$colname_test = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_test = $_SESSION['MM_Username'];
}
mysql_select_db($database_db, $alijtihad_db);
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
$test = mysql_query($query_test, $alijtihad_db) or die(mysql_error());
$row_test = mysql_fetch_assoc($test);
$totalRows_test = mysql_num_rows($test);

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
                    <td>Bukti Pembayaran</td>
                    <td colspan="2"><?php display_image($colname_test, '7'); ?></td>
                </tr>
                <tr>
                    <td>Ijazah</td>
                    <td colspan="2"><?php display_image($colname_test, '2'); ?></td>
                </tr>
                <tr>
                    <td>SKHUN</td>
                    <td colspan="2"><?php display_image($colname_test, '3'); ?></td>
                </tr>
                <tr>
                    <td>Akta Kelahiran</td>
                    <td colspan="2"><?php display_image($colname_test, '4'); ?></td>
                </tr>
                <tr>
                    <td>KTP Bapak</td>
                    <td colspan="2"><?php display_image($colname_test, '5'); ?></td>
                </tr>
                <tr>
                    <td>KTP Ibu</td>
                    <td colspan="2"><?php display_image($colname_test, '6'); ?></td>
                </tr>
            </table>

        </div>
        <input type="hidden" name="MM_upload" value="form1">
        <input type="hidden" name="id_siswa" value="<?php echo $row_test['id_siswa']; ?>">
    </form>

</div>
<?php
mysql_free_result($test);
?>
