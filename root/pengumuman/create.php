<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO pengumuman (id_pengumuman, judul_pengumuman, isi_pengumuman, tanggal_pengumuman) VALUES (%s, %s, %s, %s)", GetSQLValueString($_POST['id_pengumuman'], "int"), GetSQLValueString($_POST['judul_pengumuman'], "text"), GetSQLValueString($_POST['isi_pengumuman'], "text"), GetSQLValueString($_POST['tanggal_pengumuman'], "date"));

    mysql_select_db($database_db, $alijtihad_db);
    $Result1 = mysqli_query( $alijtihad_db, $insertSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=pengumuman"));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tambah Pengumuman</title>
    </head>

    <body>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center">
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Judul_pengumuman:</td>
                    <td><input type="text" name="judul_pengumuman" value="" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right" valign="top">Isi_pengumuman:</td>
                    <td><textarea name="isi_pengumuman" cols="50" rows="5"></textarea></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Insert record" /></td>
                </tr>
            </table>
            <input type="hidden" name="tanggal_pengumuman" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <p>&nbsp;</p>
    </body>
</html>