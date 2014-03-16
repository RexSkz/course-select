<?php
	require "sessionstart.php";
	require "constants.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>正在跳转</title>
</head>
<body>
<?php
	require "connectdatabase.php";
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	// 尝试学生身份
	$checklist = mysql_query("SELECT password FROM studentinformation WHERE id='" . $username . "'");
	$checklist = mysql_fetch_array($checklist);
	if ($checklist['password'] == $password) {
		$_SESSION['user'] = $username;
		$_SESSION['type'] = "student";
		echo '<meta http-equiv="refresh" content="0; url=index.php">';
	}
	else {
		// 尝试教师身份
		$checklist = mysql_query("SELECT password FROM teacherinformation WHERE id='" . $username . "'");
		$checklist = mysql_fetch_array($checklist);
		if ($checklist['password'] == $password) {
			$_SESSION['user'] = $username;
			$_SESSION['type'] = "teacher";
			echo '<meta http-equiv="refresh" content="0; url=index.php">';
		}
		else {
			// 尝试管理员身份
			$checklist = mysql_query("SELECT password FROM administrator WHERE username='" . $username . "'");
			$checklist = mysql_fetch_array($checklist);
			if ($checklist['password'] == $password) {
				$_SESSION['user'] = $username;
				$_SESSION['type'] = "administrator";
				echo '<meta http-equiv="refresh" content="0; url=index.php">';
			}
			else {
				echo "<script>";
				echo "alert(\"账号或密码错误！\");";
				echo "window.history.back();";
				echo "</script>";
			}
		}
	}
?>
<body>;
</html>;
