
<?php
include "../Connections/dropdown_helper.php";
include "../Connections/GetSQLValueString.php";
include "../Connections/image_display_helper.php";
require_once('../Connections/disable_cache.php');

disable_cache(true);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    
    mysql_select_db($database_db, $alijtihad_db);
        
    $updateSQL = sprintf("UPDATE siswa SET "
            . "username=%s, "
            . "password=%s, "
            . "nama_lengkap=%s, "
            . "jenis_kelamin=%s, "
            . "agama=%s, "
            . "tempat_lahir=%s, "
            . "tanggal_lahir=%s, "
            . "alamat_siswa=%s, "
            . "no_telp=%s, "
            . "NO_INDUK=%s, "
            . "tgl_masuk=%s, "
            . "anak_ke=%s, "
            . "jml_saudara=%s, "
            . "kebangsaan=%s, "
            . "bahasa=%s, "
            . "status=%s "
            . "WHERE id_siswa=%s", 
            GetSQLValueString($_POST['username'], "text"), 
            GetSQLValueString($_POST['password'], "text"), 
            GetSQLValueString($_POST['nama_lengkap'], "text"),
            GetSQLValueString($_POST['jenis_kelamin'], "int"), 
            GetSQLValueString($_POST['agama'], "int"), 
            GetSQLValueString($_POST['tempat_lahir'], "text"), 
            GetSQLValueString($_POST['tanggal_lahir'], "date"), 
            GetSQLValueString($_POST['alamat_siswa'], "text"), 
            GetSQLValueString($_POST['no_telp_siswa'], "text"), 
            GetSQLValueString($_POST['no_induk'], "text"), 
            GetSQLValueString($_POST['tgl_masuk'], "date"), 
            GetSQLValueString($_POST['anak_ke'], "int"), 
            GetSQLValueString($_POST['jml_saudara'], "int"), 
            GetSQLValueString($_POST['kebangsaan'], "int"), 
            GetSQLValueString($_POST['bahasa'], "int"), 
            GetSQLValueString($_POST['status'], "text"), 
            GetSQLValueString($_POST['id_siswa'], "int")
        );
    
    $Result1 = mysql_query($updateSQL, $alijtihad_db) or die(mysql_error());
    
    $updateBapakSQL = sprintf("UPDATE orang_tua SET "
            . "nama=%s, "
            . "tempat_lahir=%s, "
            . "tgl_lahir=%s, "
            . "alamat=%s, "
            . "no_telp=%s, "
            . "pendidikan=%s, "
            . "pekerjaan=%s, "
            . "alamat_kantor=%s, "
            . "no_telp_kantor=%s, "
            . "kebangsaan=%s, "
            . "agama=%s "
            . "WHERE orang_tua_id=%s", 
            GetSQLValueString($_POST['nama_bapak'], "text"), 
            GetSQLValueString($_POST['tempat_lahir_bapak'], "text"), 
            GetSQLValueString($_POST['tgl_lahir_bapak'], "date"),
            GetSQLValueString($_POST['alamat_bapak'], "text"), 
            GetSQLValueString($_POST['no_telp_bapak'], "text"), 
            GetSQLValueString($_POST['pendidikan_bapak'], "int"), 
            GetSQLValueString($_POST['pekerjaan_bapak'], "int"), 
            GetSQLValueString($_POST['alamat_kantor_bapak'], "text"), 
            GetSQLValueString($_POST['no_telp_kantor_bapak'], "text"), 
            GetSQLValueString($_POST['kebangsaan_bapak'], "int"), 
            GetSQLValueString($_POST['agama_bapak'], "int"), 
            GetSQLValueString($_POST['id_bapak'], "int")
        );
    
    $result_update_bapak = mysql_query($updateBapakSQL, $alijtihad_db) or die(mysql_error());
    
    $updateIbuSQL = sprintf("UPDATE orang_tua SET "
            . "nama=%s, "
            . "tempat_lahir=%s, "
            . "tgl_lahir=%s, "
            . "alamat=%s, "
            . "no_telp=%s, "
            . "pendidikan=%s, "
            . "pekerjaan=%s, "
            . "alamat_kantor=%s, "
            . "no_telp_kantor=%s, "
            . "kebangsaan=%s, "
            . "agama=%s "
            . "WHERE orang_tua_id=%s", 
            GetSQLValueString($_POST['nama_ibu'], "text"), 
            GetSQLValueString($_POST['tempat_lahir_ibu'], "text"), 
            GetSQLValueString($_POST['tgl_lahir_ibu'], "date"),
            GetSQLValueString($_POST['alamat_ibu'], "text"), 
            GetSQLValueString($_POST['no_telp_ibu'], "text"), 
            GetSQLValueString($_POST['pendidikan_ibu'], "int"), 
            GetSQLValueString($_POST['pekerjaan_ibu'], "int"), 
            GetSQLValueString($_POST['alamat_kantor_ibu'], "text"), 
            GetSQLValueString($_POST['no_telp_kantor_ibu'], "text"), 
            GetSQLValueString($_POST['kebangsaan_ibu'], "int"), 
            GetSQLValueString($_POST['agama_ibu'], "int"), 
            GetSQLValueString($_POST['id_ibu'], "int")
        );
    
    $result_update_bapak = mysql_query($updateIbuSQL, $alijtihad_db) or die(mysql_error());

    $updateGoTo = "http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
        $updateGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: " . "http://" . $_SERVER['SERVER_NAME'] . "/al-ijtihad/root/index.php?page=siswa"));
}

$colname_update = "-1";
if (isset($_GET['username'])) {
    $colname_update = $_GET['username'];
}
mysql_select_db($database_db, $alijtihad_db);
$query_update = sprintf("SELECT s.*,p.*, "
        . "ot1.orang_tua_id id_bapak, ot1.tempat_lahir tempat_lahir_bapak, ot1.tgl_lahir tgl_lahir_bapak, "
        . "ot1.alamat alamat_bapak, ot1.no_telp no_telp_bapak, ot1.pendidikan pendidikan_bapak, "
        . "ot1.pekerjaan pekerjaan_bapak, ot1.alamat_kantor alamat_kantor_bapak,ot1.no_telp_kantor no_telp_kantor_bapak,"
        . " ot1.kebangsaan kebangsaan_bapak, ot1.agama agama_bapak, ot1.nama nama_bapak,ot2.orang_tua_id id_ibu, "
        . "ot2.tempat_lahir tempat_lahir_ibu, ot2.tgl_lahir tgl_lahir_ibu, ot2.alamat alamat_ibu, "
        . "ot2.no_telp not_telp_ibu, ot2.pendidikan pendidikan_ibu, ot2.pekerjaan pekerjaan_ibu, "
        . "ot2.alamat_kantor alamat_kantor_ibu,ot2.no_telp_kantor no_telp_kantor_ibu, ot2.kebangsaan kebangsaan_ibu, "
        . "ot2.agama agama_ibu, ot2.nama nama_ibu FROM siswa s left join parameter p on s.status = p.param_value "
        . "and p.column_name = 'status' left join orang_tua ot1 on s.id_siswa = ot1.id_siswa "
        . "and ot1.tipe_orang_tua = '1' left join orang_tua ot2 on s.id_siswa = ot2.id_siswa and "
        . "ot2.tipe_orang_tua = '2' where s.username = %s", 
        GetSQLValueString($colname_update, "text"));
$update = mysql_query($query_update, $alijtihad_db) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <link rel="stylesheet" href="../member/jquery-ui.css">
    <script src="../member/jquery-1.10.2.js"></script>
    <script src="../member/jquery-ui.js"></script>
    <script>
        $('body').on('focus',".datepicker_recurring_start", function(){
            $(this).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            });
        });
    </script>
    <table width="100%">
        <tr valign="baseline">
            <td colspan="2">
                <div class="judul-web">
                    Siswa
                </div>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Id_siswa:</td>
            <td><?php echo $row_update['id_siswa']; ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Username:</td>
            <td><input type="text" name="username" value="<?php echo htmlentities($row_update['username'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Password:</td>
            <td><input type="text" name="password" value="<?php echo htmlentities($row_update['password'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nama_lengkap:</td>
            <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_update['nama_lengkap'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Jenis_kelamin:</td>
            <td><select name="jenis_kelamin" id="jenis_kelamin">
                <?php
                get_dropdown_with_selected_value("jenis_kelamin", "param_value", $row_update['jenis_kelamin']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tempat_lahir:</td>
            <td><input type="text" name="tempat_lahir" value="<?php echo htmlentities($row_update['tempat_lahir'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tanggal_lahir:</td>
            <td><input class="datepicker_recurring_start" type="text" name="tanggal_lahir" value="<?php echo htmlentities($row_update['tanggal_lahir'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Alamat_siswa:</td>
            <td><input type="text" name="alamat_siswa" value="<?php echo htmlentities($row_update['alamat_siswa'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Telepon:</td>
            <td><input type="text" name="no_telp_siswa" value="<?php echo htmlentities($row_update['no_telp'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Induk:</td>
            <td><input type="text" name="no_induk" value="<?php echo htmlentities($row_update['NO_INDUK'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tanggal Masuk:</td>
            <td><input class="datepicker_recurring_start" type="text" name="tgl_masuk" value="<?php echo htmlentities($row_update['tgl_masuk'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Anak Ke:</td>
            <td><input type="text" name="anak_ke" value="<?php echo htmlentities($row_update['anak_ke'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Jumlah Saudara:</td>
            <td><input type="text" name="jml_saudara" value="<?php echo htmlentities($row_update['jml_saudara'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Kebangsaan:</td>
            <td><select name="kebangsaan" id="agama">
                <?php
                get_dropdown_with_selected_value("kebangsaan", "param_value", $row_update['kebangsaan']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Bahasa:</td>
            <td><select name="bahasa" id="bahasa">
                <?php
                get_dropdown_with_selected_value("bahasa", "param_value", $row_update['bahasa']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Agama:</td>
            <td><select name="agama" id="agama">
                <?php
                get_dropdown_with_selected_value("agama", "param_value", $row_update['agama']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Foto:</td>
            <td><img src="../foto/<?php echo $row_update['foto']; ?>" width="200"/></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Bukti Pembayaran:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '7', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Ijazah:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '2', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">SKHUN:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '3', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Akta Kelahiran:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '4', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">KTP Bapak:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '5', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">KTP Ibu:</td>
            <td><?php display_image_with_path_and_width($row_update['username'], '6', "../foto/", "300"); ?></td>
        </tr>
        <tr valign="baseline">
            <td colspan="2">
                <div class="judul-web">
                    Bapak
                </div>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nama</td>
            <td><input type="text" name="nama_bapak" value="<?php echo htmlentities($row_update['nama_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tempat Lahir</td>
            <td><input type="text" name="tempat_lahir_bapak" value="<?php echo htmlentities($row_update['tempat_lahir_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tanggal Lahir</td>
            <td><input class="datepicker_recurring_start" type="text" name="tgl_lahir_bapak" value="<?php echo htmlentities($row_update['tgl_lahir_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Alamat</td>
            <td><input type="text" name="alamat_bapak" value="<?php echo htmlentities($row_update['alamat_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Telepon</td>
            <td><input type="text" name="no_telp_bapak" value="<?php echo htmlentities($row_update['no_telp_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Pendidikan:</td>
            <td><select name="pendidikan_bapak" id="agama">
                <?php
                get_dropdown_with_selected_value("pendidikan", "param_value", $row_update['pedidikan_bapak']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Pekerjaan:</td>
            <td><select name="pekerjaan_bapak" id="agama">
                <?php
                get_dropdown_with_selected_value("pekerjaan", "param_value", $row_update['pekerjaan_bapak']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Alamat Kantor</td>
            <td><input type="text" name="alamat_kantor_bapak" value="<?php echo htmlentities($row_update['alamat_kantor_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Telepon Kantor</td>
            <td><input type="text" name="no_telp_kantor_bapak" value="<?php echo htmlentities($row_update['no_telp_kantor_bapak'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Suku Bangsa:</td>
            <td><select name="kebangsaan_bapak" id="agama">
                <?php
                get_dropdown_with_selected_value("kebangsaan", "param_value", $row_update['kebangsaan_bapak']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Agama:</td>
            <td><select name="agama_bapak" id="agama">
                <?php
                get_dropdown_with_selected_value("agama", "param_value", $row_update['agama_bapak']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td colspan="2">
                <div class="judul-web">
                    Ibu
                </div>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Nama</td>
            <td><input type="text" name="nama_ibu" value="<?php echo htmlentities($row_update['nama_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tempat Lahir</td>
            <td><input type="text" name="tempat_lahir_ibu" value="<?php echo htmlentities($row_update['tempat_lahir_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Tanggal Lahir</td>
            <td><input class="datepicker_recurring_start" type="text" name="tgl_lahir_ibu" value="<?php echo htmlentities($row_update['tgl_lahir_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Alamat</td>
            <td><input type="text" name="alamat_ibu" value="<?php echo htmlentities($row_update['alamat_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Telepon</td>
            <td><input type="text" name="no_telp_ibu" value="<?php echo htmlentities($row_update['not_telp_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Pendidikan:</td>
            <td><select name="pendidikan_ibu" id="agama">
                <?php
                 get_dropdown_with_selected_value("pendidikan", "param_value", $row_update['pendidikan_ibu']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Pekerjaan:</td>
            <td><select name="pekerjaan_ibu" id="agama">
                <?php
                get_dropdown_with_selected_value("pekerjaan", "param_value", $row_update['pekerjaan_ibu']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Alamat Kantor</td>
            <td><input type="text" name="alamat_kantor_ibu" value="<?php echo htmlentities($row_update['alamat_kantor_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">No Telepon Kantor</td>
            <td><input type="text" name="no_telp_kantor_ibu" value="<?php echo htmlentities($row_update['no_telp_kantor_ibu'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Suku Bangsa:</td>
            <td><select name="kebangsaan_ibu" id="agama">
                <?php
                get_dropdown_with_selected_value("kebangsaan", "param_value", $row_update['kebangsaan_ibu']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Agama:</td>
            <td><select name="agama_ibu" id="agama">
                <?php
                get_dropdown_with_selected_value("agama", "param_value", $row_update['agama_ibu']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td colspan="2">
                <div class="judul-web">
                    Status
                </div>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">Status:</td>
            <td><select name="status" id="status">
                <?php
                get_dropdown_with_selected_value("status", "param_value", $row_update['status']);
                ?>
                </select>
            </td>
        </tr>
        <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Update record" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="id_siswa" value="<?php echo $row_update['id_siswa']; ?>">
    <input type="hidden" name="id_bapak" value="<?php echo $row_update['id_bapak']; ?>">
    <input type="hidden" name="id_ibu" value="<?php echo $row_update['id_ibu']; ?>">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($update);
?>