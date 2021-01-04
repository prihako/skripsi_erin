
<?php

include "../Connections/dropdown_helper.php";
include "../Connections/GetSQLValueString.php";
require_once('../Connections/disable_cache.php');

disable_cache(true);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_index = 10;
$pageNum_index = 0;
if (isset($_GET['pageNum_index'])) {
    $pageNum_index = $_GET['pageNum_index'];
}
$startRow_index = $pageNum_index * $maxRows_index;


if (isset($_GET['pageNum_index'])) {
    $pageNum_index = $_GET['pageNum_index'];
}

$agama = '';
$jenis_kelamin = '';

if(isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] != "0" ){
    $jenis_kelamin = GetSQLValueString($_POST['jenis_kelamin'], 'int');
}

if(isset($_POST['agama']) && $_POST['agama'] != "0"){
    $agama = GetSQLValueString($_POST['agama'], 'int');
}

mysql_select_db($database_db, $alijtihad_db);
$query_index = "SELECT s.*, "
        . "p_status.param_name as status_desc, "
        . "p_agama.param_name as agama_desc, "
        . "p_jen_kel.param_name as jenis_kelamin_desc  "
        . "FROM siswa s "
        . "left join parameter p_status on s.status = p_status.param_value and p_status.column_name = 'status' "
        . "left join parameter p_agama on s.agama = p_agama.param_value and p_agama.column_name = 'agama' "
        . "left join parameter p_jen_kel on s.jenis_kelamin = p_jen_kel.param_value and p_jen_kel.column_name = 'jenis_kelamin' "
        . "where s.jenis_kelamin like '%" . $jenis_kelamin . "%' "
        . "and s.agama like '%" . $agama . "%' "
        . "and s.status = '5' ";

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
<br />
<!--<a href="http://localhost/al-ijtihad/root/index.php?page=tambah-siswa">Tambah Siswa</a><br />-->
<br />
<div class="input-identitas">
    <form action="<?php echo $editFormAction; ?>" method="POST">
        <div class="input-identitas">
            <div class="input-label">
                Jenis Kelamin
                <label for="jenis_kelamin"></label>
            </div>  
             <select name="jenis_kelamin" >
                <?php
                
                if($jenis_kelamin != ''){
                    get_dropdown_with_all_and_selected_value("jenis_kelamin", "param_value", $jenis_kelamin);
                }else{
                    get_dropdown_with_all("jenis_kelamin", "param_value");
                }

                ?>
            </select>
        </div><div class="clear"></div>
        <div class="input-identitas">
            <div class="input-label">
                Agama
                <label for="agama"></label>
            </div>  
            <select name="agama" >
            <?php
            
            if($agama != ''){
                get_dropdown_with_all_and_selected_value("agama", "param_value", $agama);
            }else{
                get_dropdown_with_all("agama", "param_value");
            }

            ?>
            </select>
        </div><div class="clear"></div>
        <center>
            <input name="" type="submit" value="Sortir" />
            <!--<button id="cetak" > Cetak </button>-->
        </center>
    </form>
</div>

<div id="data-siswa"><center>
        <h1>Input Nilai Calon Siswa </h1>
    </center>
    <table border="1" align="center" class="table">
        <thead>
            <tr>
                <td width="15">No</td>
                <td width="120">Nama Lengkap</td>
                <td width="70">Jenis Kelamin</td>
                <td width="39">Agama</td>
                <td width="100">Alamat Siswa</td>
                <td width="111">Nomor Induk</td>
                <td width="54">Nilai</td>
                <td width="100" class="action">Pilihan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row_index = mysql_fetch_array($index)) {
                ?>
                <tr>
                    <td><?php echo $no ?> </a></td>
                    <td><?php echo $row_index['nama_lengkap']; ?>&nbsp; </td>
                    <td><?php echo $row_index['jenis_kelamin_desc']; ?>&nbsp; </td>
                    <td><?php echo $row_index['agama_desc']; ?>&nbsp; </td>
                    <td><?php echo $row_index['alamat_siswa']; ?>&nbsp; </td>
                    <td><?php echo $row_index['NO_INDUK']; ?>&nbsp; </td>
                    <td>
						<?php 
							$query_hasil_test = sprintf("select test.id_hasil_test, test.nilai, "
									. "siswa.id_siswa,  pelajaran.id_mata_pelajaran, pelajaran.nama_mata_pelajaran "
									. "from hasil_test test, siswa siswa, mata_pelajaran pelajaran "
									. "where test.id_siswa = siswa.id_siswa "
									. "and pelajaran.id_mata_pelajaran = test.id_mata_pelajaran "
									. "and siswa.id_siswa = %s ",
									GetSQLValueString($row_index['id_siswa'], "int"));
							$result_hasil_test = mysql_query($query_hasil_test, $alijtihad_db) or die(mysql_error());
							while ($row_hasil_test = mysql_fetch_array($result_hasil_test)) {
								echo $row_hasil_test['nama_mata_pelajaran'] . " : " . $row_hasil_test['nilai'] . ", ";
							}
						?>&nbsp; 
					</td>
                    <td class="action">
						<a class="btn btn-mini" href="http://localhost/al-ijtihad/root/index.php?page=create-nilai&id_siswa=<?php echo $row_index['id_siswa']; ?>">Input</a> <a class="btn btn-mini" href="http://localhost/al-ijtihad/root/index.php?page=view-nilai&id_siswa=<?php echo $row_index['id_siswa']; ?>">View</a>
					</td>
                </tr>
    <?php 
		$no++;
		} 
	?>
        </tbody>
    </table>

</div>
<br /><div class="navigator">

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
