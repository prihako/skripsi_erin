<?php
if (!function_exists("log_to_file")) {

    function log_to_file($msg) {  
	    date_default_timezone_set("Asia/Jakarta");
		$rootFolder = $_SERVER['DOCUMENT_ROOT'];
		$filename = $rootFolder. DIRECTORY_SEPARATOR . "logging.log";
		
		// open file 
		if (file_exists($filename)) {
		  $fd = fopen($filename, 'a');
		} else {
		  $fd = fopen($filename, 'w');
		} 

	   // append date/time to message 
	   $str = "[" . date("d/m/Y h:i:s A", time()) . "] " . $msg;  
	   // write string 
	   fwrite($fd, $str . "\n"); 
	   // close file 
	   fclose($fd); 
   } 

}

if (!function_exists("log_to_file_v2")) {

    function log_to_file_v2($msg, $file, $line_number) {  
	    date_default_timezone_set("Asia/Jakarta");
		$rootFolder = $_SERVER['DOCUMENT_ROOT'];
		$filename = $rootFolder. DIRECTORY_SEPARATOR . "logging.log";
		
		// open file 
		if (file_exists($filename)) {
		  $fd = fopen($filename, 'a');
		} else {
		  $fd = fopen($filename, 'w');
		} 

	   // append date/time to message 
	   $str = "[" . date("d/m/Y h:i:s A", time()) . "] [" . $file . ":" . $line_number . "] \t" .$msg;  
	   // write string 
	   fwrite($fd, $str . "\n"); 
	   // close file 
	   fclose($fd); 
   } 

}
?>
