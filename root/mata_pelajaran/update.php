<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $updateSQL = sprintf("UPDATE mata_pelajaran SET nama_mata_pelajaran=%s, nilai_minimum=%s WHERE id_mata_pelajaran=%s", GetSQLValueString($_POST['nama_mata_pelajaran'], "text"), GetSQLValueString($_POST['nilai_minimum'], "int"), GetSQLValueString($_POST['id_mata_pelajaran'], "int"));

    mysql_select_db($database_db, $alijtihad_db);
    $Result1 = mysqli_query( $alijtihad_db, $updateSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=mata-pelajaran"));
}

$colname_update = "-1";
if (isset($_GET['id_mata_pelajaran'])) {
    $colname_update = $_GET['id_mata_pelajaran'];
}
mysqli_select_db($alijtihad_db, $database_db);
$query_update = sprintf("SELECT * FROM mata_pelajaran WHERE id_mata_pelajaran = %s", GetSQLValueString($colname_update, "int"));
$update = mysqli_query($alijtihad_db, $query_update);
$row_update = mysqli_fetch_assoc($update);
$totalRows_update = mysqli_num_rows($update);

mysqli_free_result($update);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table align="center">
        <tr valign="baseline">
            <td nowrap align="right">Mata Pelajaran:</td>
            <td><input type="text" name="nama_mata_pelajaran" value="<?php echo htmlentities($row_update['nama_mata_pelajaran'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nilai Minimum:</td>
            <td><input type="text" name="nilai_minimum" value="<?php echo htmlentities($row_update['nilai_minimum'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
		<tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Update record"></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_mata_pelajaran" value="<?php echo $row_update['id_mata_pelajaran']; ?>">
</form>
<p>&nbsp;</p>
