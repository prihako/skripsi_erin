<title> Manajemen Admin </title>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
    $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

$query_index = "SELECT * FROM admin";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysqli_query($alijtihad_db, $query_limit_index);
$row_index = mysqli_fetch_assoc($index);

if (isset($_GET['totalRows_index'])) {
    $totalRows_index = $_GET['totalRows_index'];
} else {
    $all_index = mysqli_query($alijtihad_db, $query_index);
    $totalRows_index = mysqli_num_rows($all_index);
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
<a href="<?php echo get_base_url() . '/al-ijtihad/root/index.php?page=tambah-admin'; ?>">Tambah Admin</a><br />
<table border="1" align="center">
    <tr>
        <td>username</td>
        <td>password</td>
        <td>nama_lengkap</td>
        <td>Pilihan</td>
    </tr>
<?php do { ?>
        <tr>
            <td>
                <!--<a href="admin/detail.php?recordID=<?php echo $row_index['id_admin']; ?>">--> 
                <?php echo $row_index['username']; ?>&nbsp; 
                <!--</a>-->
            </td>
            <td><?php echo $row_index['password']; ?>&nbsp; </td>
            <td><?php echo $row_index['nama_lengkap']; ?>&nbsp; </td>
            <td><a href="<?php echo get_base_url() . '/al-ijtihad/root/index.php?page=edit-admin&id_admin=' . $row_index['id_admin']; ?>">Edit</a> | <a href="<?php echo get_base_url() . '/al-ijtihad/root/index.php?page=hapus-admin&id_admin=' . $row_index['id_admin']; ?>">Hapus</a></td>
        </tr>
<?php } while ($row_index = mysqli_fetch_assoc($index)); ?>
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
    <?php mysqli_free_result($index);
    ?>
