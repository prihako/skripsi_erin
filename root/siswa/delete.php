
<?php

if ((isset($_GET['id_siswa'])) && ($_GET['id_siswa'] != "")) {
    
  $deleteSQL = sprintf("DELETE FROM siswa WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));
  
  $deleteOrangTuaSQL = sprintf("DELETE FROM orang_tua WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));
  
  $deleteDocumentSQL = sprintf("DELETE FROM orang_tua WHERE id_siswa=%s",
                       GetSQLValueString($_GET['id_siswa'], "int"));

  $Result1 = mysqli_query($alijtihad_db, $deleteSQL);
  $Result2 = mysqli_query($alijtihad_db,$deleteOrangTuaSQL) ;
  $Result3 = mysqli_query($alijtihad_db, $deleteDocumentSQL) ;

  header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=siswa"));
}
?>
