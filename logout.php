<?php require "sessionstart.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>正在跳转</title>
</head>
<body>
<?php
	session_destroy();
	echo '<meta http-equiv="refresh" content="0; url=index.php">';
?>
<body>;
</html>;
