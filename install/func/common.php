<?php
function  clean($data) {
	if (is_array($data)) {
		foreach ($data as $key => $value) {
			unset($data[$key]);

			$data[clean($key)] = clean($value);
		}
	} else {
		$data = htmlspecialchars($data, ENT_COMPAT);
	}

	return $data;
}
function template($path,$data=array(),$value=FALSE) {

	if(is_array($data)){
		extract($data);
	}
	ob_start();

	require TEMPLATE.$path;

	$applied_template = ob_get_contents();
	ob_end_clean();

	if($value) {
		return $applied_template;
	}
	else {

		echo $applied_template;
	}
}
function base_url(){
	$protocol = (@$_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	
	return $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
}
