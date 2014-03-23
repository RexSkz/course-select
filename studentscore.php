<?php
	require "sessionstart.php";
	require "constants.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['score'])) {
		$score = $_POST['score'];
		require "connectdatabase.php";
		if (isset($_GET['coursename'])) {
			$checklist = mysql_query("SELECT * FROM coursechoose WHERE teacherid='" . $user . "' AND courseName='" . $_GET['coursename'] . "' ORDER BY courseID, id");
		}
		else {
			$checklist = mysql_query("SELECT * FROM coursechoose WHERE teacherid='" . $user . "' ORDER BY courseID, id");
		}
		$error = false;
		while ($row = mysql_fetch_array($checklist)) {
			$value = $score[0];
			if ($value < 0 || $value > 100) {
				echo "<script>alert('输入的成绩超出范围！\\n错误信息：" . $row['name'] . " " .
				$row['courseName'] . " " . $value . "');</script>";
				$error = true;
			}
			else {
				mysql_query("UPDATE coursechoose SET score='" . $value . "' WHERE recordID='" . $row['recordID'] . "'");
			}
			array_shift($score);
		}
		$faulttext = "";
		if ($error == true) {
			$faulttext = "\\n输入出错的数据均保留原值。";
		}
		echo '<script>alert("修改学生成绩成功！' . $faulttext . '");</script>';
		echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?page=studentscore\">";
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>学生成绩评定</h3>
	<p>
		<span>按课程名称过滤：</span>
		<select onchange="self.location.href='index.php?page=studentscore' + options[selectedIndex].value" name="select">
		<?php
			if (isset($_GET['coursename'])) {
				$coursename = $_GET['coursename'];
			}
			else {
				$coursename = "所有课程";
			}
			echo '<option value="">所有课程</option>';
			require "connectdatabase.php";
			$checklist = mysql_query("SELECT name FROM courseinformation WHERE teacherid='" . $user . "' ORDER BY id");
			while ($row = mysql_fetch_array($checklist)) {
				if ($row['name'] == $coursename) {
					$selected = ' selected="selected"';
				}
				else {
					$selected = "";
				}
				echo '<option value="&coursename=' . $row['name'] . '"' . $selected . '>' . $row['name'] . '</option>';
			}
		?>
		</select>
	</p>
	<form action="studentscore.php" method="post">
		<table style="border:1px solid #99F;width:100%;">
			<tr style="background-color:#CCC;">
				<td>课程编号</td><td>课程名称</td><td>学生学号</td><td>学生姓名</td><td>应得分数</td>
			</tr>
		<?php
			require "connectdatabase.php";
			if (isset($_GET['coursename'])) {
				$checklist = mysql_query("SELECT * FROM coursechoose WHERE teacherid='" . $user . "' AND courseName='" . $_GET['coursename'] . "' ORDER BY courseID, id");
			}
			else {
				$checklist = mysql_query("SELECT * FROM coursechoose WHERE teacherid='" . $user . "' ORDER BY courseID, id");
			}
			$i = 0;
			while ($row = mysql_fetch_array($checklist)) {
				$i++;
				if ($i % 2 == 0) {
					$highlight = " style=\"background-color:#DDD;\"";
				}
				else {
					$highlight = " style=\"background-color:#EEE;\"";
				}
				echo "<tr" . $highlight . ">";
				echo "<td>" . $row['courseID'] . "</td>";
				echo "<td>" . $row['courseName'] . "</td>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo '<td><input name="score[]" type="text" style="text-align:center;" value="' . $row['score'] . '" /></td>';
				echo "</tr>";
			}
		?>
		</table>
		<p>
			<input type="submit" value="保存修改" />
			<input type="reset" value="返回修改前状态" />
		</p>
	</form>
	<br />
</div>
