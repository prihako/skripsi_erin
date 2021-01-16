<?php
include "../Connections/dropdown_helper.php";
include "../Connections/image_display_helper.php";
require_once('../Connections/disable_cache.php');

disable_cache(true);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    mysql_select_db($database_db, $alijtihad_db);

    foreach($_POST['check_list'] as $selected){
         $updateSQL = sprintf("UPDATE siswa SET "
            . "status=%s "
            . "WHERE id_siswa=%s", 
            GetSQLValueString('3', "text"), 
            GetSQLValueString($selected, "int")
    );

    $Result1 = mysqli_query($alijtihad_db, $updateSQL);
    }

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=verifikasi-pemb"));
}

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
    $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;

$colname_update = "-1";
if (isset($_GET['username'])) {
    $colname_update = $_GET['username'];
}

$query_index = "SELECT * from siswa s where s.status = '2' ";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysqli_query($alijtihad_db, $query_limit_index);

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

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <div id="data-siswa"><center>
            <h1>Validasi Dokumen Pembayaran </h1>
        </center>
        <table border="1" align="center" class="table">
            <thead>
                <tr>
                    <td width="15">No</td>
                    <td width="120">Username</td>
                    <td width="70">Nama Lengkap</td>
                    <td width="420">Dokumen Pembayaran</td>
                    <td width="30" class="action">Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row_index = mysqli_fetch_assoc($index)) {
                    ?>
                    <tr>
                        <td><?php echo $no ?> </a></td>
                        <td><?php echo $row_index['username']; ?>&nbsp; </td>
                        <td><?php echo $row_index['nama_lengkap']; ?>&nbsp; </td>
                        <td><?php display_image_with_path_and_width($row_index['username'], '7', "../foto/", "410"); ?> </td>
                        <td class="action"><input type="checkbox"  name="check_list[]" value="<?php echo $row_index['id_siswa']; ?>" /></td>
                    </tr>
                    <?php
                    $no++;
                } 
                ?>
                    <tr valign="baseline">
                    <td colspan="5" align="center" ><input type="submit" value="Validate" /></td>
                    </tr>
            </tbody>
        </table>

    </div>
    <br />
    <div class="navigator">
        <div class="tombolnext">
            <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, min($totalPages_index, $pageNum_index + 1), $queryString_index); ?>">Selanjutnya</a>
        </div>

        <div class="tombolprev">
            <a href="<?php printf("%s?pageNum_index=%d%s", $currentPage, max(0, $pageNum_index - 1), $queryString_index); ?>">Sebelumnya</a>

        </div>
        <div class="total-data">
            data <?php echo ($startRow_index + 1) ?> sampai <?php echo min($startRow_index + $maxRows_index, $totalRows_index) ?> dari <?php echo $totalRows_index ?> data
        </div>
    </div>
    <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
<?php
mysqli_free_result($index);
?>