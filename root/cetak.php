<?php require_once('../Connections/database_db.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_index = 1000;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
  $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

mysql_select_db($database_db, $alijtihad_db);

$query_index = "SELECT s.*, "
        . "p_status.param_name as status_desc, "
        . "p_agama.param_name as agama_desc, "
        . "p_jen_kel.param_name as jenis_kelamin_desc  "
        . "FROM siswa s "
        . "left join parameter p_status on s.status = p_status.param_value and p_status.column_name = 'status' "
        . "left join parameter p_agama on s.agama = p_agama.param_value and p_agama.column_name = 'agama' "
        . "left join parameter p_jen_kel on s.jenis_kelamin = p_jen_kel.param_value and p_jen_kel.column_name = 'jenis_kelamin' ";
		
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysql_query($query_limit_index, $alijtihad_db) or die(mysql_error());
$row_index = mysql_fetch_assoc($index);

if (isset($_GET['totalRows_index'])) {
  $totalRows_index = $_GET['totalRows_index'];
} else {
  $all_index = mysql_query($query_index);
  $totalRows_index = mysql_num_rows($all_index);
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
$queryString_index = sprintf("&totalRows_index=%d%s", $totalRows_index, $queryString_index); ?>

<div>
    <div class="row">
 
        <h3>
            Daftar Siswa
          <button id="cetak" class="btn pull-right">Cetak</button>
        </h3>
         
      <div id="data-siswa">
         
        <!-- tampilkan ketika dalam mode print -->
      
        <table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th width="1%">#</th>
                <th width="5%">Nama</th>
                <th width="3%">JK</th>
                <th width="3%">Agama</th>
                <th width="7%">Alamat</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
<?php if ($totalRows_index > 0) { // Show if recordset not empty ?>
<?php
  $no = 1;
   do { ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row_index['nama_lengkap']; ?>&nbsp; </td>
				<td><?php echo $row_index['jenis_kelamin_desc']; ?>&nbsp; </td>
                <td><?php echo $row_index['agama_desc']; ?>&nbsp; </td>
                <td><?php echo $row_index['alamat_siswa']; ?>&nbsp; </td>
                <td><?php echo $row_index['status_desc']; ?></td>
            </tr>
              <?php $no++; } while ($row_index = mysql_fetch_assoc($index)); ?>
            <?php } 
			else {echo"kosong";}
			?>
        </tbody>
        </table>      
         
        </div>
    </div>
</div>

<?php
mysql_free_result($index);
?>
