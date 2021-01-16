
<?php
include "Connections/upload-foto.php";
include "Connections/dropdown_helper.php";
date_default_timezone_set("Asia/Jakarta");

$lokasi_file;
$nama_file;
$nama_file_to_saved;
if(isset($_FILES['fupload'])){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file = $_FILES['fupload']['name'];
	$nama_file_to_saved = date("dmY_h_i_s_A", time()) . "_" . (round(microtime(true) * 1000)). "_" . $nama_file ;
}
?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    
    $insertGoTo = "index.php";
    if (!empty($lokasi_file)) {
        UploadGaleri($nama_file_to_saved);
    } else {
        $nama_file = "no-image.jpg";
    }
     
    $insertSQL = sprintf("INSERT INTO siswa ("
                . "username, "
                . "password, "
                . "nama_lengkap, "
                . "jenis_kelamin, "
                . "agama, "
                . "tempat_lahir, "
                . "tanggal_lahir, "
                . "alamat_siswa, "
                . "foto, "
                . "no_telp, "
                . "no_induk, "
                . "tgl_masuk, "
                . "anak_ke, "
                . "jml_saudara, "
                . "kebangsaan, "
                . "bahasa, "
                . "status) "
                . "VALUES "
                . "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                GetSQLValueString($_POST['username'], "text"), 
                GetSQLValueString($_POST['password'], "text"), 
                GetSQLValueString($_POST['nama_lengkap'], "text"), 
                GetSQLValueString($_POST['jenis_kelamin'], "int"), 
                GetSQLValueString($_POST['agama'], "int"), 
                GetSQLValueString($_POST['tempat_lahir'], "text"), 
                GetSQLValueString($_POST['tanggal_lahir'], "date"),  
                GetSQLValueString($_POST['alamat_siswa'], "text"), 
                GetSQLValueString($nama_file_to_saved, "text"),
                GetSQLValueString($_POST['no_telp'], "text"),
                GetSQLValueString($_POST['no_induk'], "text"),
                GetSQLValueString($_POST['tanggal_masuk'], "date"),
                GetSQLValueString($_POST['anak_ke'], "int"),
                GetSQLValueString($_POST['jml_saudara'], "int"), 
                GetSQLValueString($_POST['kebangsaan'], "int"),
                GetSQLValueString($_POST['bahasa'], "int"),
                GetSQLValueString('1', "text")
                );

    $Result1 = mysqli_query($alijtihad_db, $insertSQL) or die(mysqli_error($alijtihad_db));
    
    $id_siswa = mysqli_insert_id($alijtihad_db);
    
    $insertSQLBapak = sprintf("INSERT INTO orang_tua ("
                . "nama, "
                . "tempat_lahir, "
                . "tgl_lahir, "
                . "alamat, "
                . "no_telp, "
                . "pendidikan, "
                . "pekerjaan, "
                . "alamat_kantor, "
                . "no_telp_kantor, "
                . "kebangsaan, "
                . "agama, "
                . "id_siswa,"
                . "tipe_orang_tua) "
                . "VALUES "
                . "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                GetSQLValueString($_POST['nama_lengkap_bapak'], "text"), 
                GetSQLValueString($_POST['tempat_lahir_bapak'], "text"), 
                GetSQLValueString($_POST['tanggal_lahir_bapak'], "date"), 
                GetSQLValueString($_POST['alamat_bapak'], "text"), 
                GetSQLValueString($_POST['no_telp_bapak'], "text"), 
                GetSQLValueString($_POST['pendidikan_bapak'], "int"), 
                GetSQLValueString($_POST['pekerjaan_bapak'], "int"),  
                GetSQLValueString($_POST['alamat_kantor_bapak'], "text"), 
                GetSQLValueString($_POST['no_telp_kantor_bapak'], "text"),
                GetSQLValueString($_POST['kebangsaan_bapak'], "int"),
                GetSQLValueString($_POST['agama_bapak'], "int"),
                GetSQLValueString($id_siswa, "int"),
                GetSQLValueString("1", "text")
                );

    $ResultBapak = mysqli_query($alijtihad_db, $insertSQLBapak) or die(mysqli_error($alijtihad_db));;
    
    $insertSQLIbu = sprintf("INSERT INTO orang_tua ("
                . "nama, "
                . "tempat_lahir, "
                . "tgl_lahir, "
                . "alamat, "
                . "no_telp, "
                . "pendidikan, "
                . "pekerjaan, "
                . "alamat_kantor, "
                . "no_telp_kantor, "
                . "kebangsaan, "
                . "agama, "
                . "id_siswa, "
                . "tipe_orang_tua) "
                . "VALUES "
                . "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                GetSQLValueString($_POST['nama_lengkap_ibu'], "text"), 
                GetSQLValueString($_POST['tempat_lahir_ibu'], "text"), 
                GetSQLValueString($_POST['tanggal_lahir_ibu'], "date"), 
                GetSQLValueString($_POST['alamat_ibu'], "text"), 
                GetSQLValueString($_POST['no_telp_ibu'], "text"), 
                GetSQLValueString($_POST['pendidikan_ibu'], "int"), 
                GetSQLValueString($_POST['pekerjaan_ibu'], "int"),  
                GetSQLValueString($_POST['alamat_kantor_ibu'], "text"), 
                GetSQLValueString($_POST['no_telp_kantor_ibu'], "text"),
                GetSQLValueString($_POST['kebangsaan_ibu'], "int"),
                GetSQLValueString($_POST['agama_ibu'], "int"),
                GetSQLValueString($id_siswa, "int"),
                GetSQLValueString("2", "text")
                );

    $ResultIbu = mysqli_query($alijtihad_db, $insertSQLIbu) or die(mysqli_error($alijtihad_db));;
    
    if (!empty($lokasi_file)) {
        header(sprintf("Location: index.php?page=berhasil"));
    }else{
        if (isset($_SERVER['QUERY_STRING'])) {
            $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
            $insertGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: %s", $insertGoTo));
    }
    
}
?>

<!--BAGIAN ISI-->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Datepicker - Default functionality</title>
        <link rel="stylesheet" href="member/jquery-ui.css">
        <script src="member/jquery-1.10.2.js"></script>
        <script src="member/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#tanggal-lahir").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
                $("#tanggal_masuk").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
                $("#tanggal_lahir_bapak").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
                $("#tanggal_lahir_ibu").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });
        </script>
    </head>


    <div class="isi">
        <div class="judul-web">
            REGISTRASI
        </div>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
            <div class="main">
                <div class="input-identitas">
                    <div class="input-label">
                        NISN:
                        <label for="nama"></label>
                    </div>  
                    <input type="text" name="username" id="nama" class="input-daftar" maxlength="10" required>
                </div><div class="clear"></div>
                <div class="input-identitas">
                    <div class="input-label">
                        Password:
                        <label for="nama"></label>
                    </div>  
                    <input type="text" name="password" id="nama" class="input-daftar" required>
                </div><div class="clear"></div>

                <div class="judul-web">
                    Formulir Pendaftaran
                </div>
                <!--BAGIAN MAIN-->
                <div class="main">

                    <div class="input-identitas">
                        <div class="input-label">
                            Nama :
                            <label for="nama"></label>
                        </div>  
                        <input type="text" name="nama_lengkap" id="nama" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Jenis Kelamin:
                            <label for="jenis-kelamin"></label>
                        </div>
                        <label for="jenis-kelamin"></label>
                        <select name="jenis_kelamin" id="jenis-kelamin" class="input-selek" required>
                            <?php

                            get_dropdown("jenis_kelamin", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tempat Lahir :
                            <label for="tempat-lahir"></label>
                        </div>
                        <input type="text" name="tempat_lahir" id="tempat-lahir" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tanggal Lahir:
                            <label for="tanggal-lahir"></label>
                        </div>
                        <input type="text" name="tanggal_lahir" id="tanggal-lahir" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Alamat Siswa:
                            <label for="alamat"></label>
                        </div>
                        <input type="text" name="alamat_siswa" id="alamat" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Telp:
                            <label for="no_telp"></label>
                        </div>
                        <input type="text" name="no_telp" id="no_telp" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Induk:
                            <label for="no_induk"></label>
                        </div>
                        <input type="text" name="no_induk" id="no_induk" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tanggal Masuk:
                            <label for="tanggal_masuk"></label>
                        </div>
                        <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Anak Ke:
                            <label for="anak_ke"></label>
                        </div>
                        <input type="text" name="anak_ke" id="anak_ke" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Jumlah Saudara:
                            <label for="jml_saudara"></label>
                        </div>
                        <input type="text" name="jml_saudara" id="jml_saudara" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Bangsa / Suku Bangsa:
                            <label for="kebangsaan"></label>
                        </div>  
                        <select name="kebangsaan" class="input-selek" required>
                            <?php

                            get_dropdown("kebangsaan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Bahasa:
                            <label for="bahasa"></label>
                        </div>  
                        <select name="bahasa" class="input-selek" required>
                             <?php

                            get_dropdown("bahasa", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Agama:
                            <label for="agama"></label>
                        </div>  
                        <select name="agama" class="input-selek" required>
                            <?php

                            get_dropdown("agama", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            foto 3x4 
                            <label for="Foto"></label>
                        </div>
                        <input type="file" name="fupload" id="foto" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="judul-web">
                        Bapak
                    </div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nama :
                            <label for="nama_lengkap_bapak"></label>
                        </div>  
                        <input type="text" name="nama_lengkap_bapak" id="nama_lengkap_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tempat Lahir :
                            <label for="tempat_lahir_bapak"></label>
                        </div>
                        <input type="text" name="tempat_lahir_bapak" id="tempat_lahir_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tanggal Lahir:
                            <label for="tanggal_lahir_bapak"></label>
                        </div>
                        <input type="text" name="tanggal_lahir_bapak" id="tanggal_lahir_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Alamat :
                            <label for="alamat_bapak"></label>
                        </div>
                        <input type="text" name="alamat_bapak" id="alamat_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Telp:
                            <label for="no_telp_bapak"></label>
                        </div>
                        <input type="text" name="no_telp_bapak" id="no_telp_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Pendidikan :
                            <label for="pendidikan_bapak"></label>
                        </div>  
                        <select name="pendidikan_bapak" class="input-selek" required>
                            <?php

                            get_dropdown("pendidikan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Pekerjaan :
                            <label for="pekerjaan_bapak"></label>
                        </div>  
                        <select name="pekerjaan_bapak" class="input-selek" required>
                            <?php

                            get_dropdown("pekerjaan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Alamat Kantor :
                            <label for="alamat_kantor_bapak"></label>
                        </div>
                        <input type="text" name="alamat_kantor_bapak" id="alamat_kantor_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Telp Kantor :
                            <label for="no_telp_kantor_bapak"></label>
                        </div>
                        <input type="text" name="no_telp_kantor_bapak" id="no_telp_kantor_bapak" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Bangsa / Suku Bangsa:
                            <label for="kebangsaan_bapak"></label>
                        </div>  
                        <select name="kebangsaan_bapak" class="input-selek" required>
                            <?php

                            get_dropdown("kebangsaan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Agama :
                            <label for="agama_bapak"></label>
                        </div>  
                        <select name="agama_bapak" class="input-selek" required>
                            <?php
                            
                            get_dropdown("agama", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="judul-web">
                        Ibu
                    </div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nama :
                            <label for="nama_lengkap_ibu"></label>
                        </div>  
                        <input type="text" name="nama_lengkap_ibu" id="nama_lengkap_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tempat Lahir :
                            <label for="tempat_lahir_ibu"></label>
                        </div>
                        <input type="text" name="tempat_lahir_ibu" id="tempat_lahir_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Tanggal Lahir:
                            <label for="tanggal_lahir_ibu"></label>
                        </div>
                        <input type="text" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Alamat :
                            <label for="alamat_ibu"></label>
                        </div>
                        <input type="text" name="alamat_ibu" id="alamat_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Telp:
                            <label for="no_telp_ibu"></label>
                        </div>
                        <input type="text" name="no_telp_ibu" id="no_telp_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Pendidikan :
                            <label for="pendidikan_ibu"></label>
                        </div>  
                        <select name="pendidikan_ibu" class="input-selek" required>
                            <?php

                            get_dropdown("pendidikan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Pekerjaan :
                            <label for="pekerjaan_ibu"></label>
                        </div>  
                        <select name="pekerjaan_ibu" class="input-selek" required>
                            <?php

                            get_dropdown("pekerjaan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Alamat Kantor :
                            <label for="alamat_kantor_ibu"></label>
                        </div>
                        <input type="text" name="alamat_kantor_ibu" id="alamat_kantor_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Nomor Telp Kantor :
                            <label for="no_telp_kantor_ibu"></label>
                        </div>
                        <input type="text" name="no_telp_kantor_ibu" id="no_telp_kantor_ibu" class="input-daftar" required>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Bangsa / Suku Bangsa:
                            <label for="kebangsaan_ibu"></label>
                        </div>  
                        <select name="kebangsaan_ibu" class="input-selek" required>
                            <?php

                            get_dropdown("kebangsaan", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>
                    <div class="input-identitas">
                        <div class="input-label">
                            Agama :
                            <label for="agama_ibu"></label>
                        </div>  
                        <select name="agama_ibu" class="input-selek" required>
                            <?php

                            get_dropdown("agama", "param_value");
                            
                            ?>
                        </select>
                    </div><div class="clear"></div>

                    <div class="clear"></div>
                    <div class="tes">
                        <input type="submit"  value="Daftar" class="btn">
                        <input type="submit"  value="Reset" class="btn reset">
                    </div><div class="clear"></div>
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="tahun_ajaran" value="2015/2016">
                    <input type="hidden" name="MM_insert" value="form1">
                    </form> 
                </div> <!--PENUTUP ISI-->
            </div>
    </div>