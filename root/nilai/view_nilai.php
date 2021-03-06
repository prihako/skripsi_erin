<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
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


$query_hasil_test = sprintf("select test.id_hasil_test, test.nilai, "
		. "siswa.id_siswa,  pelajaran.id_mata_pelajaran, pelajaran.nama_mata_pelajaran "
		. "from hasil_test test, siswa siswa, mata_pelajaran pelajaran "
		. "where test.id_siswa = siswa.id_siswa "
		. "and pelajaran.id_mata_pelajaran = test.id_mata_pelajaran "
		. "and siswa.id_siswa = %s ",
		GetSQLValueString($colname_update, "int"));
$result_hasil_test = mysqli_query($alijtihad_db, $query_hasil_test);

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
<?php while ($row_mata_pelajaran = mysqli_fetch_array($result_hasil_test)) { ?>
        <tr valign="baseline">
            <td><p><?php echo htmlentities($row_mata_pelajaran['nama_mata_pelajaran'], ENT_COMPAT, ''); ?></p></td>
            <td><p><?php echo htmlentities($row_mata_pelajaran['nilai'], ENT_COMPAT, ''); ?></p> </td>
        </tr>
<?php } ?>
		<tr valign="baseline">
            <td colspan="2"><a href="<?php echo get_base_url() . '/al-ijtihad/root/index.php?page=input-nilai'; ?>">Back</a></td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>

<?php mysqli_free_result($result_hasil_test);
    ?>
