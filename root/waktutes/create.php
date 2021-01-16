<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO waktutest (nama_test,keterangan, waktu_test) VALUES (%s,%s, %s)", GetSQLValueString($_POST['nama_test'], "text"), GetSQLValueString($_POST['keterangan'], "text"), GetSQLValueString($_POST['waktu_test'], "date"));

    $Result1 = mysqli_query($alijtihad_db, $insertSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=waktutes"));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <link rel="stylesheet" href="../member/jquery-ui.css">
                <script src="../member/jquery-1.10.2.js"></script>
                <script src="../member/jquery-ui.js"></script>
                <script>
                    $('body').on('focus', ".datepicker_recurring_start", function () {
                        $(this).datepicker({
                            dateFormat: 'yy-mm-dd',
                            changeMonth: true,
                            changeYear: true,
                            yearRange: "-100:+0"
                        });
                    });
                </script>
                <table align="center">
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Nama_test:</td>
                        <td><input type="text" name="nama_test" value="" size="32" /></td>
                    </tr>

                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Keterangan:</td>
                        <td><input type="text" name="keterangan" value="" size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">Waktu_test:</td>
                        <td><input class="datepicker_recurring_start" type="text" name="waktu_test" value="" size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="right">&nbsp;</td>
                        <td><input type="submit" value="Insert record" /></td>
                    </tr>
                </table>
                <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <p>&nbsp;</p>
    </body>
</html>