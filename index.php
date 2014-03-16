<?php require "constants.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>选课系统</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
</head>
<body>
	<div id="whole">
		<div id="top">
			<?php require "header.php" ?>
		</div>
		<div id="bottom">
			<div id="control">
				<?php require "controlpanel.php" ?>
			</div>
			<div id="main">
				<?php
					if (isset($_GET['page'])) {
						require $_GET['page'] . ".php";
					}
					else {
						require "welcome.php";
					}
				?>
			</div>
		</div>
		<div id="footer">
			<?php require "footer.php" ?>
		</div>
	</div>
</body>
</html>
