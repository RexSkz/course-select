<?php
	require "sessionstart.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['chk'])) {
		$chk = $_POST['chk'];
		array_shift($chk);
		if ($chk == NULL) {
			echo '<script>alert("你没有选择任何课程！");</script>';
			echo '<meta http-equiv="refresh" content="0; url=index.php?page=selectcourse">';
		}
		else {
			require "constants.php";
			require "connectdatabase.php";
			$stu = mysql_query("SELECT * FROM studentinformation WHERE id='" . $user . "'");
			$stu = mysql_fetch_array($stu);
			foreach ($chk as $e) {
				$checklist = mysql_query("SELECT * FROM courseinformation WHERE id='" . $e . "'");
				$checklist = mysql_fetch_array($checklist);
				if ($checklist == NULL) {
					echo '<script>alert("课程\'' . $checklist['name'] . '\'不存在，在此之前的课已选中。");</script>';
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=selectcourse">';
					die("");
				}
				else if ($checklist['selectedNumber'] >= $checklist['capacity']) {
					echo '<script>alert("课程\'' . $checklist['name'] . '\'人数已满，在此之前的课已选中。");</script>';
					echo '<meta http-equiv="refresh" content="0; url=index.php?page=selectcourse">';
					die("");
				}
				$course = mysql_query("SELECT * FROM coursechoose WHERE id='" . $user . "' AND courseID='" . $checklist['id'] . "'");
				if (mysql_fetch_array($course) == NULL) {
					$flag = mysql_query("INSERT INTO coursechoose VALUES ('" . $user . "', '" . $stu['name'] .
						"', '" . $stu['dept'] . "', '" . $stu['major'] . "', '" . $stu['class'] . "', '" .
						$checklist['name'] . "', '" . $checklist['id'] . "', '" . $checklist['teacherID'] .
						"', NULL)");
					if ($flag == true) {
						$checklist = mysql_query("SELECT selectedNumber FROM courseinformation WHERE id='" . $e . "'");
						$checklist = mysql_fetch_array($checklist);
						$selected = $checklist['selectedNumber'] + 1;
						mysql_query("UPDATE courseinformation SET selectedNumber='" . $selected . "' WHERE id='" . $e . "'");
					}
				}
			}
			echo '<script>alert("保存成功！");</script>';
			echo '<meta http-equiv="refresh" content="0; url=index.php?page=selectcourse">';
		}
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:100%;">
	<h3>可选课程列表</h3>
	<form action="selectcourse.php" method="post">
		<p><span class="smalltitle">必修课程</span></p>
		<table style="border:1px solid #99F;">
			<tr style="background-color:#CCC;">
				<td style="width:24px;"><input style="display:none;" type="checkbox" name="chk[]" checked=1 /></td>
					<td style="width:72px;">课程编号</td>
					<td>课程名称</td>
					<td>教师姓名</td>
					<td style="width:72px;">已选人数</td>
					<td style="width:72px;">限制人数</td>
					<td>上课时间</td>
					<td style="width:72px;">上课地点</td>
					<td style="width:72px;">课程学分</td>
			</tr>
			<?php
				require "connectdatabase.php";
				$checklist = mysql_query("SELECT * FROM courseinformation WHERE comp='1' ORDER BY id");
				$i = 0;
				while ($row = mysql_fetch_array($checklist)) {
					$choose = mysql_query("SELECT * FROM coursechoose WHERE courseID='" . $row['id'] . "' AND id='" . $user . "'");
					if (mysql_fetch_array($choose) == NULL) {
						$i++;
						if ($i % 2 == 0) {
							$hightlight = " style=\"background-color:#DDD;\"";
						}
						else {
							$hightlight = " style=\"background-color:#EEE;\"";
						}
						echo "<tr" . $hightlight . ">";
						echo "<td>";
						echo '<input class="hideborder" type="checkbox" name="chk[]" value="' . $row['id'] . '" checked=1 />';
						echo '</td>';
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['teacher'] . "</td>";
						echo "<td>" . $row['selectedNumber'] . "</td>";
						echo "<td>" . $row['capacity'] . "</td>";
						echo "<td>" . $row['time'] . "</td>";
						echo "<td>" . $row['place'] . "</td>";
						echo "<td>" . $row['credit'] . "</td>";
						echo "</tr>";
					}
				}
			?>
		</table>
		<p><span class="smalltitle">选修课程</span></p>
		<table style="border:1px solid #99F;">
			<tr style="background-color:#CCC;">
				<td style="width:24px;"></td>
					<td style="width:72px;">课程编号</td>
					<td>课程名称</td>
					<td>教师姓名</td>
					<td style="width:72px;">已选人数</td>
					<td style="width:72px;">限制人数</td>
					<td>上课时间</td>
					<td style="width:72px;">上课地点</td>
					<td style="width:72px;">课程学分</td>
			</tr>
			<?php
				require "connectdatabase.php";
				$checklist = mysql_query("SELECT * FROM courseinformation WHERE comp='0' ORDER BY id");
				$i = 0;
				while ($row = mysql_fetch_array($checklist)) {
					$choose = mysql_query("SELECT * FROM coursechoose WHERE courseID='" . $row['id'] . "' AND id='" . $user . "'");
					if (mysql_fetch_array($choose) == NULL) {
						$i++;
						if ($i % 2 == 0) {
							$hightlight = " style=\"background-color:#DDD;\"";
						}
						else {
							$hightlight = " style=\"background-color:#EEE;\"";
						}
						echo "<tr" . $hightlight . ">";
						echo '<td><input class="hideborder" type="checkbox" name="chk[]" value="' . $row['id'] . '" /></td>';
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['teacher'] . "</td>";
						echo "<td>" . $row['selectedNumber'] . "</td>";
						echo "<td>" . $row['capacity'] . "</td>";
						echo "<td>" . $row['time'] . "</td>";
						echo "<td>" . $row['place'] . "</td>";
						echo "<td>" . $row['credit'] . "</td>";
						echo "</tr>";
					}
				}
			?>
		</table>
		<p>
			<input type="submit" value="保存" style="display:inline-block;width:60px;" />
			<input type="reset" value="重置" style="display:inline-block;width:60px;" />
		</p>
	</form>
</div>
