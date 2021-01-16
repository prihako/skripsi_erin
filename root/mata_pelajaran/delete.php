
<?php

if ((isset($_GET['id_mata_pelajaran'])) && ($_GET['id_mata_pelajaran'] != "")) {
    $deleteSQL = sprintf("DELETE FROM mata_pelajaran WHERE id_mata_pelajaran=%s", GetSQLValueString($_GET['id_mata_pelajaran'], "int"));

    $Result1 = mysqli_query($alijtihad_db, $deleteSQL);

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=mata-pelajaran"));
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