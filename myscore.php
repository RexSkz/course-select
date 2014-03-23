<?php
	require "sessionstart.php";
	require "constants.php";
?>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>成绩列表</h3>
	<table style="border:1px solid #99F;width:100%;">
		<tr style="background-color:#CCC;">
			<td>课程编号</td><td>课程名称</td><td>任课教师</td><td>我的成绩</td><td>课程性质</td>
		</tr>
	<?php
		require "connectdatabase.php";
		$checklist = mysql_query("SELECT * FROM coursechoose WHERE id='" . $user . "' ORDER BY courseID");
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
			$teacher = mysql_query("SELECT name FROM teacherinformation WHERE id='" . $row['teacherID'] . "'");
			$teacher = mysql_fetch_array($teacher);
			echo "<td>" . $teacher['name'] . "</td>";
			echo '<td style="font-weight:bold;">' . $row['score'] . '</td>';
			$comp = mysql_query("SELECT comp FROM courseinformation WHERE id='" . $row['courseID'] . "'");
			$comp = mysql_fetch_array($comp);
			if ($comp['comp'] == "1") {
				$comp = "必修";
			}
			else if ($comp['comp'] == "0") {
				$comp = "选修";
			}
			echo "<td>" . $comp . "</td>";
			echo "</tr>";
		}
	?>
	</table>
	<br />
</div>
