
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE admin SET username=%s, password=%s, nama_lengkap=%s WHERE id_admin=%s", GetSQLValueString($_POST['username'], "text"), GetSQLValueString($_POST['password'], "text"), GetSQLValueString($_POST['nama_lengkap'], "text"), GetSQLValueString($_POST['id_admin'], "int"));

    mysqli_select_db($alijtihad_db, $database_db);
    $Result1 = mysqli_query($alijtihad_db, $updateSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=admin"));
}

$colname_update = "-1";
if (isset($_GET['id_admin'])) {
    $colname_update = $_GET['id_admin'];
}
$query_update = sprintf("SELECT * FROM admin WHERE id_admin = %s", GetSQLValueString($colname_update, "int"));
$update = mysqli_query($alijtihad_db, $query_update) or die(mysql_error());
$row_update = mysqli_fetch_assoc($update);
$totalRows_update = mysqli_num_rows($update);

mysqli_free_result($update);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table align="center">
        <tr valign="baseline">
            <td nowrap align="right">Username:</td>
            <td><input type="text" name="username" value="<?php echo htmlentities($row_update['username'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Password:</td>
            <td><input type="text" name="password" value="<?php echo htmlentities($row_update['password'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nama_lengkap:</td>
            <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_update['nama_lengkap'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Update record"></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_admin" value="<?php echo $row_update['id_admin']; ?>">
</form>
<p>&nbsp;</p>
