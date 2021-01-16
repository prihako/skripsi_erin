<title> Detail Admin</title>
<?php require_once('../../Connections/database_db.php'); ?>
<?php

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}

$query_DetailRS1 = sprintf("SELECT * FROM mata_pelajaran WHERE id_mata_pelajaran = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysqli_query($alijtihad_db, $query_limit_DetailRS1);
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysqli_query($alijtihad_db,$query_DetailRS1);
  $totalRows_DetailRS1 = mysqli_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

mysqli_free_result($DetailRS1);
?>
		
<table border="1" align="center">
  
  <tr>
    <td>Id Mata Pelajaran</td>
    <td><?php echo $row_DetailRS1['id_mata_pelajaran']; ?> </td>
  </tr>
  <tr>
    <td>Nama Pelajaran</td>
    <td><?php echo $row_DetailRS1['nama_mata_pelajaran']; ?> </td>
  </tr>
  <tr>
    <td>Nilai Minimum</td>
    <td><?php echo $row_DetailRS1['nilai_minimum']; ?> </td>
  </tr>
  
</table>
