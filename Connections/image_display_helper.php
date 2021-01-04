<?php

if (!function_exists("display_image")) {

    function display_image($username, $document_type) {
        global $database_db;
        global $alijtihad_db;
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("select s.username, "
                . "d.document_name as image, "
                . "d.document_type "
                . "from siswa s left join document d "
                . "on s.id_siswa = d.id_siswa "
                . "where s.username = " . $username 
                . " and d.document_type = " . $document_type);
        $row = mysql_fetch_assoc($sql);
        
        if(!empty($row['image'])){
            echo "<img src='foto/" . $row['image'] . "' width='500px'/>";
        }else{
             echo "Berkas belum di-Upload";
        }
       
    }

}

if (!function_exists("display_image_with_path_and_width")) {

    function display_image_with_path_and_width($username, $document_type, $path, $width) {
        global $database_db;
        global $alijtihad_db;
        
        log_to_file_v2("username : ". $username, basename(__FILE__), __LINE__);
        log_to_file_v2("document_type : ".$document_type, basename(__FILE__), __LINE__);
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("select s.username, "
                . "d.document_name as image, "
                . "d.document_type "
                . "from siswa s left join document d "
                . "on s.id_siswa = d.id_siswa "
                . "where s.username = " . $username 
                . " and d.document_type = " . $document_type);
        $row = mysql_fetch_assoc($sql);
        
        if(!empty($row['image'])){
            echo "<img src='" . $path . $row['image'] . "' width='" . $width . "'/>";
        }else{
             echo "Berkas belum di-Upload";
        }
       
    }

}
?>