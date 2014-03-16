<?php
	require "sessionstart.php";
	if (isset($type)) {
		if ($type == "student") {
			require "controlpanelstudent.php";
		}
		else if ($type == "teacher") {
			require "controlpanelteacher.php";
		}
		else if ($type == "administrator") {
			require "controlpaneladmin.php";
		}
	}
	else {
		require "controlpanelguest.php";
	}
	echo '<div style="height:200px;"></div>';
?>
