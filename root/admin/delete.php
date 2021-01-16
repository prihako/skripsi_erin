
<?php

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
    $deleteSQL = sprintf("DELETE FROM admin WHERE id_admin=%s", GetSQLValueString($_GET['id_admin'], "int"));

    $Result1 = mysqli_query($alijtihad_db, $deleteSQL );

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=admin"));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
    </body>
</html>