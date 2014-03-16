<?php
	require "sessionstart.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['old'])) {
		require "constants.php";
		$old = $_POST['old'];
		$new = $_POST['new'];
		$rep = $_POST['rep'];
		if ($old == "") {
			echo "<script>alert('旧密码不能为空！');</script>";
			echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
		}
		else if ($new == "") {
			echo "<script>alert('新密码不能为空！');</script>";
			echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
		}
		else if ($rep != $new) {
			echo "<script>alert('两次输入的密码不一致！');</script>";
			echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
		}
		else {
			$old = md5($old);
			$new = md5($new);
			require "connectdatabase.php";
			if ($type == "student" || $type == "teacher") {
				$table = $type . "information";
				$checklist = mysql_query("SELECT password FROM " . $table . " WHERE id='" . $user . "'");
				$checklist = mysql_fetch_array($checklist);
				if ($old == $checklist['password']) {
					mysql_query("UPDATE " . $table . " SET password='" . $new . "' WHERE id='" . $user . "'");
					echo "<script>alert('修改成功！');</script>";
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
				}
				else {
					echo "<script>alert('旧密码输入错误！');</script>";
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
				}
			}
			else if ($type == "administrator") {
				$table = $type;
				$checklist = mysql_query("SELECT password FROM " . $table . " WHERE username='" . $user . "'");
				$checklist = mysql_fetch_array($checklist);
				if ($old == $checklist['password']) {
					mysql_query("UPDATE " . $table . " SET password='" . $new . "' WHERE username='" . $user . "'");
					echo "<script>alert('修改成功！');</script>";
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
				}
				else {
					echo "<script>alert('旧密码输入错误！');</script>";
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=changepassword">';
				}
			}
		}
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;">
	<h3>修改密码</h3>
	<form action="changepassword.php" method="post">
		<span style="width:100px;">旧密码</span>
		<input class="text" name="old" type="password" style="width:150px;" /><br />
		<span style="width:100px;">新密码</span>
		<input class="text" name="new" type="password" style="width:150px;" /><br />
		<span style="width:100px;">重复新密码</span>
		<input class="text" name="rep" type="password" style="width:150px;" /><br />
		<p>
			<input style="width:60px;" class="button" value="提交" type="submit" />
			<input style="width:60px;" class="button" value="重置" type="reset" />
		</p>
	</form>
</div>
