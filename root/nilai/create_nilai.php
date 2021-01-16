<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	echo var_dump($_POST);
	
	$idSiswa = $_POST["id_siswa"];
	
	$indexMataPelajaran = count($_POST['array_id_mata_pelajaran']);
	
	if( (isset($_POST["is_hasil_test_exists"]))  && (isset($_POST["is_hasil_test_exists"]) == true) ){
		$deleteHasilTestSQL = sprintf("delete from hasil_test where id_siswa = %s ", 
			GetSQLValueString($_POST['id_siswa'], "int"));
		$resultDeleteHasilTest = mysqli_query($alijtihad_db,$deleteHasilTestSQL);
	}
	
	for($i = 0; $i < $indexMataPelajaran; $i++){
		$insertSQL = sprintf("INSERT INTO hasil_test (id_siswa, id_mata_pelajaran, nilai) VALUES (%s, %s, %s)", 
			GetSQLValueString($_POST['id_siswa'], "int"), 
			GetSQLValueString($_POST['array_id_mata_pelajaran'][$i], "int"),
			GetSQLValueString($_POST['array_nilai_ujian'][$i], "int"));
		$Result1 = mysqli_query( $alijtihad_db, $insertSQL);
	}

    header(sprintf("Location: " . get_base_url() . "/al-ijtihad/root/index.php?page=input-nilai"));
}

$colname_update = "-1";
if (isset($_GET['id_siswa'])) {
    $colname_update = $_GET['id_siswa'];
}

$query_update = sprintf("SELECT s.*, "
        . "p_status.param_name as status_desc, "
        . "p_agama.param_name as agama_desc, "
        . "p_jen_kel.param_name as jenis_kelamin_desc  "
        . "FROM siswa s "
        . "left join parameter p_status on s.status = p_status.param_value and p_status.column_name = 'status' "
        . "left join parameter p_agama on s.agama = p_agama.param_value and p_agama.column_name = 'agama' "
        . "left join parameter p_jen_kel on s.jenis_kelamin = p_jen_kel.param_value and p_jen_kel.column_name = 'jenis_kelamin' "
		. "where s.id_siswa = %s ",
        GetSQLValueString($colname_update, "int"));
$update = mysqli_query($alijtihad_db, $query_update);
$row_update = mysqli_fetch_assoc($update);
$totalRows_update = mysqli_num_rows($update);

mysqli_free_result($update);


$query_mata_pelajaran = "SELECT * from mata_pelajaran";
$result_mata_pelajaran = mysqli_query( $alijtihad_db, $query_mata_pelajaran);


$query_hasil_test = sprintf("select test.id_hasil_test, test.nilai, "
		. "siswa.id_siswa,  pelajaran.id_mata_pelajaran, pelajaran.nama_mata_pelajaran "
		. "from hasil_test test, siswa siswa, mata_pelajaran pelajaran "
		. "where test.id_siswa = siswa.id_siswa "
		. "and pelajaran.id_mata_pelajaran = test.id_mata_pelajaran "
		. "and siswa.id_siswa = %s ",
		GetSQLValueString($colname_update, "int"));
$result_hasil_test = mysqli_query($alijtihad_db, $query_hasil_test);
$totalRows_hasil_test = mysqli_num_rows($result_hasil_test);
$isHasilTestExists = false;
if($totalRows_hasil_test > 0){
	$isHasilTestExists = true;
}

?>

<center>
    <h1>Data Calon Siswa </h1>
</center>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table align="center">
        <tr valign="baseline">
            <td nowrap align="right">Username:</td>
            <td><p><?php echo htmlentities($row_update['username'], ENT_COMPAT, ''); ?></p></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nama_lengkap:</td>
            <td><p><?php echo htmlentities($row_update['nama_lengkap'], ENT_COMPAT, ''); ?></p></td>
        </tr>
		<tr valign="baseline">
            <td nowrap align="right">No Induk:</td>
            <td><p><?php echo htmlentities($row_update['NO_INDUK'], ENT_COMPAT, ''); ?></p></td>
        </tr>
		<tr valign="baseline">
            <td nowrap align="right">Jenis Kelamin:</td>
            <td><p><?php echo htmlentities($row_update['jenis_kelamin_desc'], ENT_COMPAT, ''); ?></p></td>
        </tr>
		<tr valign="baseline">
            <td nowrap align="right">Alamat:</td>
            <td><p><?php echo htmlentities($row_update['alamat_siswa'], ENT_COMPAT, ''); ?></p></td>
        </tr>
    </table>
	<br /><br />
	
	<center>
		<h1>Nilai Hasil Test</h1>
	</center>
	 <table align="center">
        <tr valign="baseline">
            <td nowrap >Mata Pelajaran</td>
			<td nowrap >Nilai</td>
        </tr>
<?php 
	if($isHasilTestExists == true){
		while ($row_hasil_test = mysqli_fetch_array($result_hasil_test)) { 
?>
		<tr valign="baseline">
            <td><p><?php echo htmlentities($row_hasil_test['nama_mata_pelajaran'], ENT_COMPAT, ''); ?></p></td>
            <td><input type="text" name="array_nilai_ujian[]" size="5" value="<?php echo $row_hasil_test['nilai']; ?>">
			<input type="hidden" name="array_id_mata_pelajaran[]" value="<?php echo $row_hasil_test['id_mata_pelajaran']; ?>"> 
			</td>
        </tr>
<?php 
		}
	}else{
		while ($row_mata_pelajaran = mysqli_fetch_array($result_mata_pelajaran)) { 
?>
        <tr valign="baseline">
            <td><p><?php echo htmlentities($row_mata_pelajaran['nama_mata_pelajaran'], ENT_COMPAT, ''); ?></p></td>
            <td><input type="text" name="array_nilai_ujian[]" size="5">
			<input type="hidden" name="array_id_mata_pelajaran[]" value="<?php echo $row_mata_pelajaran['id_mata_pelajaran']; ?>"> </td>
        </tr>
<?php 
		} 
	}
?>
		<tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Update record"></td>
        </tr>
    </table>
	
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_siswa" value="<?php echo $row_update['id_siswa']; ?>">
	<input type="hidden" name="is_hasil_test_exists" value="<?php echo $isHasilTestExists; ?>">
</form>
<p>&nbsp;</p>

<?php mysqli_free_result($result_mata_pelajaran);
    ?>