<?php
//initialize the session
if (!isset($_SESSION)) {
    session_start();
}

require_once('Connections/get_sql_value.php');

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
    $logoutAction .= "&" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
    //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);

    $logoutGoTo = "login.php";
    if ($logoutGoTo) {
        header("Location: $logoutGoTo");
        exit;
    }
}
?>
<?php

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

$MM_restrictGoTo = "index.php";
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
$query_test = sprintf("SELECT "
        . "s.username, "
        . "s.foto, "
        . "s.nama_lengkap, "
        . "ot1.nama as nama_bapak, "
        . "ot2.nama as nama_ibu, "
        . "param_jen_kel.param_name as jenis_kelamin, "
        . "param_agama.param_name as agama, "
        . "p.param_value status, "
        . "p.param_name status_name "
        . "FROM siswa s left join parameter p "
        . "on s.status = p.param_value and p.column_name = 'status' "
        . "left join parameter param_jen_kel "
        . "on s.jenis_kelamin = param_jen_kel.param_value and param_jen_kel.column_name ='jenis_kelamin' "
        . "left join parameter param_agama "
        . "on s.agama = param_agama.param_value and param_agama.column_name = 'agama' "
        . "left join orang_tua ot1 "
        . "on s.id_siswa = ot1.id_siswa and ot1.tipe_orang_tua = '1' "
        . "left join orang_tua ot2 "
        . "on s.id_siswa = ot2.id_siswa and ot2.tipe_orang_tua = '2' "
        . "where s.username =%s ", GetSQLValueString($colname_test, "text"));
$test = mysqli_query($alijtihad_db, $query_test) or die(mysql_error());
$row_test = mysqli_fetch_assoc($test);
$totalRows_test = mysqli_num_rows($test);
?>
<div class="isi">

    <div class="judul-web">Selamat Datang Saudara: <?php echo $row_test['nama_lengkap']; ?> Berikut Data Diri Anda
    </div>

    <div class="main">
        <table width="100%" border="1">
            <tr>
                <td width="19%" rowspan="6"><img src="foto/<?php echo $row_test['foto']; ?>" width="200"/></td>
                <td width="19%">NISN</td>
                <td><?php echo $row_test['username']; ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td><?php echo $row_test['nama_lengkap']; ?></td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td><?php echo $row_test['nama_bapak']; ?></td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td><?php echo $row_test['nama_ibu']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?php echo $row_test['jenis_kelamin']; ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td><?php echo $row_test['agama']; ?></td>
            </tr>
            <tr>
                <td>status</td>
                <td colspan="2">
                    
                    <?php 
                    
                    if($row_test['status'] != 5){
                        echo $row_test['status_name'];
                    }else {
                        echo "Berkas anda sudah lengkap, Silahkan cetak Kartu Ujian Anda";
                    }
                    
                    ?>
                
                </td>
            </tr>
        </table>

    </div>

</div>
<?php
mysqli_free_result($test);
?>
