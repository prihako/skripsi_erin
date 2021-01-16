<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE pengumuman SET judul_pengumuman=%s, isi_pengumuman=%s, tanggal_pengumuman=%s WHERE id_pengumuman=%s", GetSQLValueString($_POST['judul_pengumuman'], "text"), GetSQLValueString($_POST['isi_pengumuman'], "text"), GetSQLValueString($_POST['tanggal_pengumuman'], "date"), GetSQLValueString($_POST['id_pengumuman'], "int"));

    $Result1 = mysqli_query($alijtihad_db, $updateSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=pengumuman"));
}

$colname_halaman_update = "-1";
if (isset($_GET['id_pengumuman'])) {
    $colname_halaman_update = $_GET['id_pengumuman'];
}
$query_halaman_update = sprintf("SELECT * FROM pengumuman WHERE id_pengumuman = %s", GetSQLValueString($colname_halaman_update, "int"));
$halaman_update = mysqli_query($alijtihad_db, $query_halaman_update);
$row_halaman_update = mysqli_fetch_assoc($halaman_update);
$totalRows_halaman_update = mysqli_num_rows($halaman_update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Edit Pengumuman</title>
    </head>

    <body>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center">
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Judul_pengumuman:</td>
                    <td><input type="text" name="judul_pengumuman" value="<?php echo htmlentities($row_halaman_update['judul_pengumuman'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Isi_pengumuman:</td>
                    <td>

                        <textarea name="isi_pengumuman" cols="50" rows="5">
<?php echo htmlentities($row_halaman_update['isi_pengumuman'], ENT_COMPAT, 'utf-8'); ?>
                        </textarea></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Tanggal_pengumuman:</td>
                    <td><input type="text" name="tanggal_pengumuman" value="<?php echo htmlentities($row_halaman_update['tanggal_pengumuman'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Update record" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="id_pengumuman" value="<?php echo $row_halaman_update['id_pengumuman']; ?>" />
        </form>
        <p>&nbsp;</p>
    </body>
</html>
<?php
mysqli_free_result($halaman_update);
?>
