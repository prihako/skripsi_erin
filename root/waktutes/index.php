<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
  $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

$query_index = "SELECT * FROM waktutest";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysqli_query($alijtihad_db, $query_limit_index);

if (isset($_GET['totalRows_index'])) {
  $totalRows_index = $_GET['totalRows_index'];
} else {
  $all_index = mysqli_query($alijtihad_db, $query_index);
  $totalRows_index = mysqli_num_rows($all_index);
}
$totalPages_index = ceil($totalRows_index/$maxRows_index)-1;

$queryString_index = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_index") == false && 
        stristr($param, "totalRows_index") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_index = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_index = sprintf("&totalRows_index=%d%s", $totalRows_index, $queryString_index);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<a href="index.php?page=tambahwaktutes"> Tambah Waktu Tes </a><br />

<table border="0" width="100%" align="center">
  <tr>
    <td>id_waktutes</td>
    <td>nama_test</td>
    <td>waktu_test</td>
    <td>Pilihan</td>
  </tr>
  <?php while ($row_index = mysqli_fetch_array($index)) { ?>
    <tr>
      <td><?php echo $row_index['id_waktutes']; ?>&nbsp;</td>
      <td><?php echo $row_index['nama_test']; ?>&nbsp; </td>
      <td><?php echo $row_index['waktu_test']; ?>&nbsp; </td>
      <td><a href="index.php?page=editwaktutes&id_waktutes=<?php echo $row_index['id_waktutes']; ?>">Edit</a> | <a href="index.php?page=hapuswaktutes&id_waktutes=<?php echo $row_index['id_waktutes']; ?>">Hapus</a></td>
    </tr>
    <?php } ?>
</table>
<br />
<table border="0">
  <tr>
    <td><?php if ($pageNum_index > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, 0, $queryString_index); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_index > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, max(0, $pageNum_index - 1), $queryString_index); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_index < $totalPages_index) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, min($totalPages_index, $pageNum_index + 1), $queryString_index); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_index < $totalPages_index) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, $totalPages_index, $queryString_index); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
Records <?php echo ($startRow_index + 1) ?> to <?php echo min($startRow_index + $maxRows_index, $totalRows_index) ?> of <?php echo $totalRows_index ?>
</body>
</html>
<?php
mysqli_free_result($index);
?>
