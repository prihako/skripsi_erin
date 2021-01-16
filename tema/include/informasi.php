
<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_halaman_utama = 2;
$pageNum_halaman_utama = 0;
if (isset($_GET['pageNum_halaman_utama'])) {
  $pageNum_halaman_utama = $_GET['pageNum_halaman_utama'];
}
$startRow_halaman_utama = $pageNum_halaman_utama * $maxRows_halaman_utama;

$query_halaman_utama = "SELECT * FROM pengumuman";
$query_limit_halaman_utama = sprintf("%s LIMIT %d, %d", $query_halaman_utama, $startRow_halaman_utama, $maxRows_halaman_utama);
$halaman_utama = mysqli_query($alijtihad_db, $query_limit_halaman_utama) ;
$row_halaman_utama = mysqli_fetch_assoc($halaman_utama);

if (isset($_GET['totalRows_halaman_utama'])) {
  $totalRows_halaman_utama = $_GET['totalRows_halaman_utama'];
} else {
  $all_halaman_utama = mysqli_query($alijtihad_db, $query_halaman_utama);
  $totalRows_halaman_utama = mysqli_num_rows($all_halaman_utama);
}
$totalPages_halaman_utama = ceil($totalRows_halaman_utama/$maxRows_halaman_utama)-1;

$queryString_halaman_utama = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_halaman_utama") == false && 
        stristr($param, "totalRows_halaman_utama") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_halaman_utama = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_halaman_utama = sprintf("&totalRows_halaman_utama=%d%s", $totalRows_halaman_utama, $queryString_halaman_utama);
?>
<!--BAGIAN ISI-->
<div class="isi">
 <?php do { ?>
<div class="judul-web">
<a href="detail.php?recordID=<?php echo $row_halaman_utama['id_pengumuman']; ?>"> <?php echo $row_halaman_utama['judul_pengumuman']; ?>&nbsp; </a>
</div>
<!--BAGIAN MAIN-->
<div class="main">

      <td><?php echo $row_halaman_utama['isi_pengumuman']; ?>&nbsp; </td>
      <div class="keterangan-pengumuman">diterbitkan pada: <?php echo $row_halaman_utama['tanggal_pengumuman']; ?> </div>
      </div>
      
    <?php } while ($row_halaman_utama = mysqli_fetch_assoc($halaman_utama)); ?>

<br /><div class="navigator">

<div class="tombolnext">
  <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, min($totalPages_halaman_utama, $pageNum_halaman_utama + 1), $queryString_halaman_utama); ?>">Selanjutnya</a>
</div>

<div class="tombolprev">
  <a href="<?php printf("%s?pageNum_halaman_utama=%d%s", $currentPage, max(0, $pageNum_halaman_utama - 1), $queryString_halaman_utama); ?>">Sebelumnya</a>
  
</div>
<div class="total-data">
data <?php echo ($startRow_halaman_utama + 1) ?> sampai <?php echo min($startRow_halaman_utama + $maxRows_halaman_utama, $totalRows_halaman_utama) ?> dari <?php echo $totalRows_halaman_utama ?> data
</div>
<?php
mysqli_free_result($halaman_utama);
?>
</div>

</div> <!--PENUTUP ISI-->
</div> <!--penutup container-->