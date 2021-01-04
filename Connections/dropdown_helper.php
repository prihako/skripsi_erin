<?php

if (!function_exists("get_dropdown")) {

    function get_dropdown($column_name, $order_by) {
        global $database_db;
        global $alijtihad_db;
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("SELECT * FROM parameter WHERE COLUMN_NAME = '" . $column_name . "' ORDER BY " . $order_by . " ASC");

        if (mysql_num_rows($sql) != 0) {
            while ($data = mysql_fetch_assoc($sql)) {
                echo '<option value=' . $data['param_value'] . '>' . $data['param_name'] . '</option>';
            }
        }
    }

}

if (!function_exists("get_dropdown_with_all")) {

    function get_dropdown_with_all($column_name, $order_by) {
        global $database_db;
        global $alijtihad_db;
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("SELECT * FROM parameter WHERE COLUMN_NAME = '" . $column_name . "' ORDER BY " . $order_by . " ASC");

        echo '<option value="0">All</option>';
        
        if (mysql_num_rows($sql) != 0) {
            while ($data = mysql_fetch_assoc($sql)) {
                echo '<option value=' . $data['param_value'] . '>' . $data['param_name'] . '</option>';
            }
        }
    }

}

if (!function_exists("get_dropdown_with_selected_value")) {

    function get_dropdown_with_selected_value($column_name, $order_by, $selected_value) {
        global $database_db;
        global $alijtihad_db;
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("SELECT * FROM parameter WHERE COLUMN_NAME = '" . $column_name . "' ORDER BY " . $order_by . " ASC");

        if (mysql_num_rows($sql) != 0) {
            while ($data = mysql_fetch_assoc($sql)) {
                if(strcmp($data['param_value'],$selected_value) == 0){
                    echo '<option value=' . $data['param_value'] . ' selected="selected" >' . $data['param_name'] . '</option>';
                }else{
                    echo '<option value=' . $data['param_value'] . '>' . $data['param_name'] . '</option>';
                }
            }
        }
    }

}

if (!function_exists("get_dropdown_with_all_and_selected_value")) {

    function get_dropdown_with_all_and_selected_value($column_name, $order_by, $selected_value) {
        global $database_db;
        global $alijtihad_db;
        
        mysql_select_db($database_db, $alijtihad_db);
        $sql = mysql_query("SELECT * FROM parameter WHERE COLUMN_NAME = '" . $column_name . "' ORDER BY " . $order_by . " ASC");

        echo '<option value="0">All</option>';
        
        if (mysql_num_rows($sql) != 0) {
            while ($data = mysql_fetch_assoc($sql)) {
                if(strcmp($data['param_value'],$selected_value) == 0){
                    echo '<option value=' . $data['param_value'] . ' selected="selected" >' . $data['param_name'] . '</option>';
                }else{
                    echo '<option value=' . $data['param_value'] . '>' . $data['param_name'] . '</option>';
                }
            }
        }
    }

}
?>