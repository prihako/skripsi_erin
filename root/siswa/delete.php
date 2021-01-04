
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
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

if ((isset($_GET['id_siswa'])) && ($_GET['id_siswa'] != "")) {
    
  mysql_select_db($database_db, $alijtihad_db);
    
  $deleteSQL = sprintf("DELETE FROM siswa WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));
  
  $deleteOrangTuaSQL = sprintf("DELETE FROM orang_tua WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));
  
  $deleteDocumentSQL = sprintf("DELETE FROM orang_tua WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));

  $Result1 = mysql_query($deleteSQL, $alijtihad_db) or die(mysql_error());
  $Result2 = mysql_query($deleteOrangTuaSQL, $alijtihad_db) or die(mysql_error());
  $Result3 = mysql_query($deleteDocumentSQL, $alijtihad_db) or die(mysql_error());

  header(sprintf("Location: " . "http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=siswa"));
}
?>
