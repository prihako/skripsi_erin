<?php

if (!function_exists("get_base_url")) {

    function get_base_url(){
		return sprintf(
			"%s://%s",
			isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME']
		);
	}

}
?>