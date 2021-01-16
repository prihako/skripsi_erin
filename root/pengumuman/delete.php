<?php

include "../../Connections/database_db.php";

if ((isset($_GET['id_pengumuman'])) && ($_GET['id_pengumuman'] != "")) {
    $deleteSQL = sprintf("DELETE FROM pengumuman WHERE id_pengumuman=%s", GetSQLValueString($_GET['id_pengumuman'], "int"));

    $Result1 = mysqli_query( $alijtihad_db, $deleteSQL) or die(mysql_error());

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=pengumuman"));
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