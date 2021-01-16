<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db = "localhost";
$database_db = "alijtihad_db";
$username_db = "root";
$password_db = "";
$alijtihad_db = mysqli_connect($hostname_db, $username_db, $password_db, $database_db); 

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($alijtihad_db, $database_db);

?>