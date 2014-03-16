<?php
	require "sessionstart.php";
	require "constants.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['chk'])) {
		//
		echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?page=studentscore\">";
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>学生成绩评定</h3>
	<form action="studentscore.php" method="post">
		<table style="border:1px solid #99F;width:100%;">
			<tr style="background-color:#CCC;">
				<td>课程编号</td><td>课程名称</td><td>课程性质</td><td>学生姓名</td><td>应得分数</td>
			</tr>
		<?php
			require "connectdatabase.php";
			$checklist = mysql_query("SELECT * FROM coursechoose WHERE teacherid='" . $user . "' ORDER BY id");
			$i = 0;
			while ($row = mysql_fetch_array($checklist)) {
				$i++;
				if ($i % 2 == 0) {
					$hightlight = " style=\"background-color:#DDD;\"";
				}
				else {
					$hightlight = " style=\"background-color:#EEE;\"";
				}
				echo "<tr" . $hightlight . ">";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['selectedNumber'] . "</td>";
				echo "<td>" . $row['capacity'] . "</td>";
				echo "<td>" . $row['time'] . "</td>";
				echo "<td>" . $row['place'] . "</td>";
				echo "<td>" . $row['week'] . "</td>";
				echo "<td>" . $row['credit'] . "</td>";
				if ($row['comp'] == "1") {
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
			<input type="submit" value="删除选中课程" />
			<input type="reset" value="清除所有选择" />
		</p>
	</form>
	<br />
</div>
