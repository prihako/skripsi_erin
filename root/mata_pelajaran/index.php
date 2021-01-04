<title> Manajemen Mata Pelajaran </title>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
    $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

mysql_select_db($database_db, $alijtihad_db);
$query_index = "SELECT * FROM mata_pelajaran";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysql_query($query_limit_index, $alijtihad_db) or die(mysql_error());

if (isset($_GET['totalRows_index'])) {
    $totalRows_index = $_GET['totalRows_index'];
} else {
    $all_index = mysql_query($query_index);
    $totalRows_index = mysql_num_rows($all_index);
}
$totalPages_index = ceil($totalRows_index / $maxRows_index) - 1;

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
<a href="http://localhost/al-ijtihad/root/index.php?page=tambah-mata-pelajaran">Tambah Mata Pelajaran</a><br />
<table border="1" align="center">
    <tr>
        <td>Nama Mata Pelajaran</td>
        <td>Nilai Minimum</td>
        <td>Pilihan</td>
    </tr>
<?php while ($row_index = mysql_fetch_array($index)) { ?>
        <tr>
            <td><?php echo $row_index['nama_mata_pelajaran']; ?>&nbsp; </td>
            <td><?php echo $row_index['nilai_minimum']; ?>&nbsp; </td>
            <td><a href="http://localhost/al-ijtihad/root/index.php?page=edit-mata-pelajaran&id_mata_pelajaran=<?php echo $row_index['id_mata_pelajaran']; ?>">Edit</a> | <a href="http://localhost/al-ijtihad/root/index.php?page=hapus-mata-pelajaran&id_mata_pelajaran=<?php echo $row_index['id_mata_pelajaran']; ?>">Hapus</a></td>
        </tr>
<?php } ?>
</table>
<br><div class="navigator">

    <div class="tombolnext">
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, min($totalPages_index, $pageNum_index + 1), $queryString_index); ?>">Selanjutnya</a>
    </div>

    <div class="tombolprev">
        <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, max(0, $pageNum_index - 1), $queryString_index); ?>">Sebelumnya</a>

    </div>
    <div class="total-data">
        data <?php echo ($startRow_index + 1) ?> sampai <?php echo min($startRow_index + $maxRows_index, $totalRows_index) ?> dari <?php echo $totalRows_index ?> data
    </div>
    <?php mysql_free_result($index);
    ?>
