<?php 
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

require_once('../Connections/database_db.php'); 

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_db, $alijtihad_db);
  
  $LoginRS__query=sprintf("SELECT username, password FROM siswa WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($alijtihad_db, $LoginRS__query);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <p>
    <label>NISN
      <input type="text" name="username" id="username">
    </label>
    <br>
    <label>Password
      <input type="text" name="password" id="password">
    </label>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Login">
  </p>
</form>
