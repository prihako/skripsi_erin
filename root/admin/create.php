<title> Tambah Admin</title>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO admin (username, password, nama_lengkap) VALUES (%s, %s, %s)", GetSQLValueString($_POST['username'], "text"), GetSQLValueString($_POST['password'], "text"), GetSQLValueString($_POST['nama_lengkap'], "text"));

    mysql_select_db($database_db, $alijtihad_db);
    $Result1 = mysql_query($insertSQL, $alijtihad_db) or die(mysql_error());

    header(sprintf("Location: " . "http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=admin"));
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
