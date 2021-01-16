<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE waktutest SET nama_test=%s,keterangan=%s, waktu_test=%s WHERE id_waktutes=%s",
                       GetSQLValueString($_POST['nama_test'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['waktu_test'], "date"),
                       GetSQLValueString($_POST['id_waktutes'], "int"));

  $Result1 = mysqli_query( $alijtihad_db, $updateSQL) or die(mysql_error());

  header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=waktutes"));
}

$colname_edit = "-1";
if (isset($_GET['id_waktutes'])) {
  $colname_edit = $_GET['id_waktutes'];
}
$query_edit = sprintf("SELECT * FROM waktutest WHERE id_waktutes = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysqli_query($alijtihad_db, $query_edit) ;
$row_edit = mysqli_fetch_assoc($edit);
$totalRows_edit = mysqli_num_rows($edit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id_waktutes:</td>
      <td><?php echo $row_edit['id_waktutes']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_test:</td>
      <td><input type="text" name="nama_test" value="<?php echo htmlentities($row_edit['nama_test'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Keterangan:</td>
      <td><input type="text" name="keterangan" value="<?php echo htmlentities($row_edit['keterangan'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Waktu_test:</td>
      <td><input type="text" name="waktu_test" value="<?php echo htmlentities($row_edit['waktu_test'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_waktutes" value="<?php echo $row_edit['id_waktutes']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($edit);
?>
