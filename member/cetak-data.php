<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once('../Connections/database_db.php'); 
require_once('../Connections/get_sql_value.php'); 
require_once('../Connections/url_helper.php'); 

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
$query_panggilan = "SELECT "
        . "s.*, "
        . "DATE_FORMAT(s.tanggal_lahir, '%m-%d-%Y') as tanggal_lahir_desc, "
        . "p_jen_kel.param_name as jenis_kelamin_desc, "
        . "ot.nama as nama_orang_tua "
        . "FROM siswa s left join parameter p_jen_kel "
        . "on s.jenis_kelamin = p_jen_kel.param_value and p_jen_kel.column_name ='jenis_kelamin' "
        . "left join orang_tua ot on s.id_siswa = ot.id_siswa and tipe_orang_tua = '1' "
        . "WHERE username = " . GetSQLValueString($colname_test, "text");
$panggilan = mysqli_query($alijtihad_db, $query_panggilan);
$row_panggilan = mysqli_fetch_assoc($panggilan);
$totalRows_panggilan = mysqli_num_rows($panggilan);
            
$query_cetak = sprintf("SELECT * FROM siswa WHERE username = %s", GetSQLValueString($colname_test, "text"));
$cetak = mysqli_query( $alijtihad_db, $query_panggilan);
$row_cetak = mysqli_fetch_assoc($cetak);
$totalRows_cetak = mysqli_num_rows($cetak);

$query_admin = sprintf("SELECT * FROM admin");
$admin = mysqli_query($alijtihad_db, $query_admin) ;
$row_admin = mysqli_fetch_assoc($admin);

$query_waktu = "SELECT nama_test, keterangan, DATE_FORMAT(waktu_test, '%m-%d-%Y') as waktu_test FROM waktutest";
$waktu = mysqli_query($alijtihad_db, $query_waktu);

?>
<?php
ob_start();
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Nama Siswa</title>
    <link href="print.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <img src="head_al_ijtihad.PNG" width="700" height="100" />
    <div class="formulir-header">
        <strong>FORMULIR PENDAFTARAN</strong><br />
        Nomor : <?php echo $row_panggilan['id_siswa']; ?>/SMA/PSB/2015
    </div>

    <table width="800" border="0" cellpadding="5" cellspacing="5" >
        <tr>
            <td width="23"><strong>1</strong></td>
            <td width="200">Nama Calon Siswa</td>
            <td width="18">:</td>
            <td style="text-transform:capitalize" width="541"><?php echo $row_panggilan['nama_lengkap']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?php echo $row_panggilan['jenis_kelamin_desc']; ?></td>
        </tr> 
        <tr>
            <td>&nbsp;</td>
            <td><span class="field-label">Tempat dan Tanggal Lahir</span></td>
            <td>:</td>
            <td><?php echo $row_panggilan['tempat_lahir']; ?>,<?php echo $row_panggilan['tanggal_lahir_desc']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span class="field-label">Nama Orang Tua / Wali</span></td>
            <td>:</td>
            <td><?php echo $row_panggilan['nama_orang_tua']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span class="field-label">Alamat Siswa</span></td>
            <td>:</td>
            <td><?php echo $row_panggilan['alamat_siswa']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span class="field-label">Nama Asal Sekolah</span></td>
            <td>:</td>
            <td><?php echo $row_panggilan['NO_INDUK']; ?></td>
        </tr>
    </table>
    <table width="551" border="0">
        <tr>
            <td width="29"><strong>2</strong></td>
            <td colspan="3"><strong>PELAKSANAAN TEST </strong></td>
            <td width="12"><strong>3</strong></td>
            <td width="121"><strong>Ruangan TES</strong></td>
            <td width="71">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="252"> 
                <?php while ($row_waktu = mysqli_fetch_assoc($waktu)) { ?>
                        <?php echo $row_waktu['nama_test']; ?>  : <?php echo $row_waktu['waktu_test']; ?> <br /> 
                <?php } ?> 
            </td>
            <td>



            </td>
            <td>



            </td>

            <td>&nbsp;</td>
            <td style="border:1px solid #333">&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php
                    $Ruangan = $row_panggilan['id_siswa'];
                    if ($Ruangan <= 25) {
                        echo "Ruangan 1";
                    } else if ($Ruangan <= 50) {
                        echo "Ruangan 2";
                    } else if ($Ruangan <= 75) {
                        echo "Ruangan 3";
                    } else if ($Ruangan <= 100) {
                        echo "Ruangan 4";
                    } else if ($Ruangan <= 125) {
                        echo "Ruangan 5";
                    } else if ($Ruangan <= 150) {
                        echo "Ruangan 6";
                    } else if ($Ruangan <= 175) {
                        echo "Ruangan 7";
                    } else if ($Ruangan <= 200) {
                        echo "Ruangan 8";
                    } else if ($Ruangan <= 225) {
                        echo "Ruangan 9";
                    } else if ($Ruangan <= 250) {
                        echo "Ruangan 10";
                    } else if ($Ruangan <= 275) {
                        echo "Ruangan 11";
                    } else if ($Ruangan <= 300) {
                        echo "Ruangan 12";
                    } else if ($Ruangan <= 325) {
                        echo "Ruangan 13";
                    } else if ($Ruangan <= 350) {
                        echo "Ruangan 14";
                    } else if ($Ruangan <= 375) {
                        echo "Ruangan 15";
                    } else if ($Ruangan <= 400) {
                        echo "Ruangan 16";
                    } else if ($Ruangan <= 425) {
                        echo "Ruangan 17";
                    } else {
                        echo "gak punya Ruangan";
                    }
                    ?></strong></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="color:#fff;padding:10px;">&nbsp;</td>
            <td style="color:#fff;padding:10px;">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>






                Petugas PSB Online




<?php echo $row_admin['nama_lengkap']; ?><br />
                NIP:  <?php echo $row_admin['nip']; ?>
            </td>
            <td colspan="3" align="right">
                <br />
                <br />
                <br />    <img src="../foto/<?php echo $row_panggilan['foto']; ?>" alt="" width="100" /></td>
            <td> </td>
            <td>






                Tangerang , <?php echo date('d-M-Y'); ?>

                Pendaftar,




<?php echo $row_panggilan['nama_lengkap']; ?>
                &nbsp;</td>
        </tr>
    </table>
    <p>========================================================================================</p>
    <p><br />
    </p>
</body>
</html>

<?php
$filename = "tugas-akhir-" . $nama = $row_panggilan['username'] . ".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya  
//==========================================================================================================  
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF  
//==========================================================================================================  
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . nl2br($content) . '</page>';
require_once(dirname(__FILE__) . '../../html2pdf/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(11, 5, 5, 0));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?> <?php
mysqli_free_result($cetak);

mysqli_free_result($panggilan);
?>