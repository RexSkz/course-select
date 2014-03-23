<?php
	require "sessionstart.php";
	require "constants.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['chk'])) {
		$chk = $_POST['chk'];
		array_shift($chk);
		if ($chk == NULL) {
			echo '<script>alert("您没有选择任何课程！");</script>';
		}
		else {
			require "connectdatabase.php";
			foreach($chk as $e){
				$course = mysql_query("SELECT * FROM coursechoose WHERE courseID='". $e ."' AND id='" . $user . "'");
				if (mysql_fetch_array($course) != NULL) {
					mysql_query("DELETE FROM coursechoose WHERE courseID='". $e ."' AND id='" . $user . "'");
					$course = mysql_query("SELECT selectedNumber FROM courseinformation WHERE id='" . $e . "'");
					$course = mysql_fetch_array($course);
					$selected = $course['selectedNumber'] - 1;
					mysql_query("UPDATE courseinformation SET selectedNumber='" . $selected . "' WHERE id='" . $e . "'");
				}
			}
			echo '<script>alert("选中课程已删除。");</script>';
		}
		echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?page=selectedcourse\">";
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>已选课程</h3>
	<form action="selectedcourse.php" method="post">
		<table style="border:1px solid #99F;">
			<tr style="background-color:#CCC;">
				<td style="width:24px;"><input style="display:none;" type="checkbox" name="chk[]" checked=1 /></td>
				<td style="width:72px;">课程编号</td>
				<td>课程名称</td>
				<td>教师姓名</td>
				<td>上课时间</td>
				<td style="width:72px;">上课地点</td>
				<td style="width:72px;">课程学分</td>
				<td style="width:72px;">课程性质</td>
			</tr>
		<?php
			require "connectdatabase.php";
			$checklist = mysql_query("SELECT courseID FROM coursechoose WHERE id='" . $user . "' ORDER BY courseID");
			$i = 0;
			while ($row = mysql_fetch_array($checklist)) {
				$course = mysql_query("SELECT * FROM courseinformation WHERE id='" . $row['courseID'] . "'");
				$course = mysql_fetch_array($course);
				$i++;
				if ($i % 2 == 0) {
					$highlight = " style=\"background-color:#DDD;\"";
				}
				else {
					$highlight = " style=\"background-color:#EEE;\"";
				}
				echo "<tr" . $highlight . ">";
				echo '<td><input class="hideborder" type="checkbox" name="chk[]" value="' . $course['id'] . '" /></td>';
				echo "<td>" . $course['id'] . "</td>";
				echo "<td>" . $course['name'] . "</td>";
				echo "<td>" . $course['teacher'] . "</td>";
				echo "<td>" . $course['time'] . "</td>";
				echo "<td>" . $course['place'] . "</td>";
				echo "<td>" . $course['credit'] . "</td>";
				if ($course['comp'] == "1") {
					$comp = "必修";
				}
				else {
					$comp = "选修";
				}
				echo "<td>" . $comp . "</td>";
				echo "</tr>";
			}
		?>
		</table>
		<p>
			<input type="submit" value="退课" />
			<input type="reset" value="重置" />
		</p>
	</form>
	<br />
</div>
