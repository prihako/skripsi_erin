<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
    session_start();
}

require_once('Connections/get_sql_value.php');

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
    $loginUsername = $_POST['Username'];
    $password = $_POST['Password'];
    $MM_fldUserAuthorization = "";
    $MM_redirectLoginSuccess = "index.php?page=siswa";
    $MM_redirectLoginFailed = "index.php?page=gagal";
    $MM_redirecttoReferrer = false;
	
    $LoginRS__query = sprintf("SELECT username, password FROM siswa WHERE username=%s AND password=%s", GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
    
    $LoginRS = mysqli_query($alijtihad_db, $LoginRS__query);
    $loginFoundUser = mysqli_num_rows($LoginRS);

    if ($loginFoundUser) {
        $loginStrGroup = "";

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(true);
        } else {
            session_regenerate_id();
        }
        //declare two session variables and assign them
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;

        if (isset($_SESSION['PrevUrl']) && false) {
            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
        }
        header("Location: " . $MM_redirectLoginSuccess);
    } else {
        header("Location: " . $MM_redirectLoginFailed);
    }
}
?>