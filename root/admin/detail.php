<title> Detail Admin</title>
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
$query_DetailRS1 = sprintf("SELECT * FROM admin WHERE id_admin = %s", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysqli_query($alijtihad_db, $query_limit_DetailRS1) or die(mysql_error());
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;

mysqli_free_result($DetailRS1);
?>
		
<table border="1" align="center">
  
  <tr>
    <td>id_admin</td>
    <td><?php echo $row_DetailRS1['id_admin']; ?> </td>
  </tr>
  <tr>
    <td>username</td>
    <td><?php echo $row_DetailRS1['username']; ?> </td>
  </tr>
  <tr>
    <td>password</td>
    <td><?php echo $row_DetailRS1['password']; ?> </td>
  </tr>
  <tr>
    <td>nama_lengkap</td>
    <td><?php echo $row_DetailRS1['nama_lengkap']; ?> </td>
  </tr>
  
  
</table>
