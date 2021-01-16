<?

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        if (PHP_VERSION < 6)
        {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

		$hostname_dbx = "localhost";
		$database_dbx = "alijtihad_db";
		$username_dbx = "root";
		$password_dbx = "";
		$alijtihad_dbx = mysqli_connect($hostname_dbx, $username_dbx, $password_dbx, $database_dbx); 
        $theValue = mysqli_real_escape_string($alijtihad_dbx, $theValue);

        switch ($theType)
        {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        }
        return $theValue;
    }
?>
