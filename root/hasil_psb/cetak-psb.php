<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once('../../Connections/database_db.php');
require_once('../../Connections/get_sql_value.php');
require_once('../../Connections/url_helper.php');

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
    // For security, start by assuming the visitor is NOT authorized. 
    $isValid = False;

    // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
    // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
    if (!empty($UserName)) {
        // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
        // Parse the strings into arrays. 
        $arrUsers = Explode(",", $strUsers);
        $arrGroups = Explode(",", $strGroups);
        if (in_array($UserName, $arrUsers)) {
            $isValid = true;
        }
        // Or, you may restrict access to only certain users based on their username. 
        if (in_array($UserGroup, $arrGroups)) {
            $isValid = true;
        }
        if (($strUsers == "") && true) {
            $isValid = true;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = get_base_url() . "/al-ijtihad/index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?"))
        $MM_qsChar = "&";
    if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
        $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
    $MM_restrictGoTo = $MM_restrictGoTo . $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: " . $MM_restrictGoTo);
    exit;
}
?>
<?php


$colname_test = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_test = $_SESSION['MM_Username'];
}

ob_start();
$maxRows_index = 1000;
$pageNum_index = 0;
$startRow_index = $pageNum_index * $maxRows_index;

$query_index = "SELECT s.*, "
        . "p_status.param_name as status_desc, "
        . "p_agama.param_name as agama_desc, "
        . "p_jen_kel.param_name as jenis_kelamin_desc  "
        . "FROM siswa s "
        . "left join parameter p_status on s.status = p_status.param_value and p_status.column_name = 'status' "
        . "left join parameter p_agama on s.agama = p_agama.param_value and p_agama.column_name = 'agama' "
        . "left join parameter p_jen_kel on s.jenis_kelamin = p_jen_kel.param_value and p_jen_kel.column_name = 'jenis_kelamin' "
        . "where "
        . "s.status = '5' ";
$query_limit_index = sprintf("%s LIMIT %d, %d", $query_index, $startRow_index, $maxRows_index);
$index = mysqli_query($alijtihad_db, $query_limit_index);


$query_mata_pelajaran = "SELECT * from mata_pelajaran ";
$result_mata_pelajaran = mysqli_query($alijtihad_db, $query_mata_pelajaran);

?>
<?php
ob_start();
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Hasil PSB</title>
    <link href="print.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <img src="head_al_ijtihad.PNG" width="700" height="100" />
    <div style="text-align: center; width:842px">
       <strong>HASIL PENDAFTARAN SISWA BARU</strong>
    </div>
	
    <table width="800" border="1" style="border-collapse: collapse;"  >
        <tr align="center">
            <td width="20">No</td>
            <td width="50">Username</td>
            <td width="100">Nama Lengkap</td>
			<td width="50">Jenis Kelamin</td>
			<td width="50">No Induk</td>
			<td width="100">Alamat</td>
			<td width="100">Nilai</td>
			<td width="80">Ket</td>
        </tr>
		<?php
		$no = 1;
		while ($row_index = mysqli_fetch_array($index)) {
		?>
        <tr>
			<td><?php echo $no ?></td>
			<td><?php echo $row_index['username']; ?> </td>
			<td>
			<?php 
					$alamat = $row_index['nama_lengkap']; 
					$alamat_array = explode(" ", $alamat);
					$size = count($alamat_array);
					$final_alamat = "";
					for($i=0;$i<$size;$i++){
						$numOfWord = $i+1;

						if($numOfWord%2 == 0){
							$final_alamat = $final_alamat . " " . $alamat_array[$i] . "<br />";
						}else{
							$final_alamat = $final_alamat . " " . $alamat_array[$i];
						}
						
					}
					echo $final_alamat; 
			?> 
			</td>
			<td><?php echo $row_index['jenis_kelamin_desc']; ?> </td>
			<td><?php echo $row_index['NO_INDUK']; ?> </td>
			<td>
				<?php 
					$alamat = $row_index['alamat_siswa']; 
					$alamat_array = explode(" ", $alamat);
					$size = count($alamat_array);
					$final_alamat = "";
					for($i=0;$i<$size;$i++){
						$numOfWord = $i+1;

						if($numOfWord%2 == 0){
							$final_alamat = $final_alamat . " " . $alamat_array[$i] . "<br />";
						}else{
							$final_alamat = $final_alamat . " " . $alamat_array[$i];
						}
						
					}
					echo $final_alamat; 
				?> 
			</td>
			<td>
				<?php 
					$query_hasil_test = sprintf("select test.id_hasil_test, test.nilai, "
							. "siswa.id_siswa,  pelajaran.id_mata_pelajaran, pelajaran.nama_mata_pelajaran "
							. "from hasil_test test, siswa siswa, mata_pelajaran pelajaran "
							. "where test.id_siswa = siswa.id_siswa "
							. "and pelajaran.id_mata_pelajaran = test.id_mata_pelajaran "
							. "and siswa.id_siswa = %s ",
							GetSQLValueString($row_index['id_siswa'], "int"));
					$result_hasil_test = mysqli_query($alijtihad_db, $query_hasil_test) or die(mysqli_error($alijtihad_db));
					while ($row_hasil_test = mysqli_fetch_array($result_hasil_test)) {
						echo $row_hasil_test['nama_mata_pelajaran'] . " : " . $row_hasil_test['nilai'] . ", ";
						echo "<br />";
					}
				?> 
			</td>
			<td align="center">
				<?php 
					$query_hasil_test = sprintf("select test.id_hasil_test, test.nilai, "
							. "siswa.id_siswa,  pelajaran.id_mata_pelajaran, pelajaran.nama_mata_pelajaran, "
							. "pelajaran.nilai_minimum "
							. "from hasil_test test, siswa siswa, mata_pelajaran pelajaran "
							. "where test.id_siswa = siswa.id_siswa "
							. "and pelajaran.id_mata_pelajaran = test.id_mata_pelajaran "
							. "and siswa.id_siswa = %s ",
							GetSQLValueString($row_index['id_siswa'], "int"));
					$result_hasil_test = mysqli_query($alijtihad_db, $query_hasil_test);

					$isLulus = false;
					while ($row_hasil_test = mysqli_fetch_array($result_hasil_test)) {
						if($row_hasil_test['nilai'] < $row_hasil_test['nilai_minimum']){
							$isLulus = false;
							break;
						}
						$isLulus = true;
					}
					
					if($isLulus == true){
						echo "LULUS";
					}else{
						echo "TIDAK<br />LULUS";
					}
						
				?> 
			</td>
		</tr>
		<?php 
		$no++;
		} 
		?>
    </table>

	<strong>Keterangan : </strong>
	<table width="400px" border="1" style="border-collapse: collapse;"  >
        <tr align="center">
            <td width="20">No</td>
            <td width="200">Nama Mata Pelajaran</td>
            <td width="80">Nilai Minimum</td>
        </tr>
		<?php
		$no = 1;
		while ($row_mata_pelajaran = mysqli_fetch_array($result_mata_pelajaran)) {
		?>
        <tr>
			<td><?php echo $no ?></td>
			<td><?php echo $row_mata_pelajaran['nama_mata_pelajaran']; ?> </td>
			<td><?php echo $row_mata_pelajaran['nilai_minimum']; ?> </td>
		</tr>
		<?php 
			$no++;
			} 
		?>
    </table>
    
</body>
</html>

<?php
$filename = "HASIL_PENERIMAAN_SISWA_BARU.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya  
//==========================================================================================================  
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF  
//==========================================================================================================  
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . nl2br($content) . '</page>';
require_once(dirname(__FILE__) . '../../../html2pdf/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(10, 0, 0, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>

<?php
mysqli_free_result($index);
mysqli_free_result($result_mata_pelajaran);
?>