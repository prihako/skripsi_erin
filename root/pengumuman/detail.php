<?php

$maxRows_DetailRS1 = 2;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
$query_DetailRS1 = sprintf("SELECT * FROM pengumuman WHERE id_pengumuman = %s", GetSQLValueString($colname_DetailRS1, "int"));
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail Pengumuman</title>
</head>

<body>

<table border="1" align="center">
  <tr>
    <td>id_pengumuman</td>
    <td><?php echo $row_DetailRS1['id_pengumuman']; ?></td>
  </tr>
  <tr>
    <td>judul_pengumuman</td>
    <td><?php echo $row_DetailRS1['judul_pengumuman']; ?></td>
  </tr>
  <tr>
    <td>isi_pengumuman</td>
    <td><?php echo $row_DetailRS1['isi_pengumuman']; ?></td>
  </tr>
  <tr>
    <td>tanggal_pengumuman</td>
    <td><?php echo $row_DetailRS1['tanggal_pengumuman']; ?></td>
  </tr>
</table>
</body>
</html><?php
mysqli_free_result($DetailRS1);
?>