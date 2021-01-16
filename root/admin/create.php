<title> Tambah Admin</title>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO admin (username, password, nama_lengkap) VALUES (%s, %s, %s)", GetSQLValueString($_POST['username'], "text"), GetSQLValueString($_POST['password'], "text"), GetSQLValueString($_POST['nama_lengkap'], "text"));

    $Result1 = mysqli_query($alijtihad_db, $insertSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=admin"));
}
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table align="center">
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Username:</td>
            <td><input type="text" name="username" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Password:</td>
            <td><input type="text" name="password" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nama_lengkap:</td>
            <td><input type="text" name="nama_lengkap" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
