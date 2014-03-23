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
				mysql_query("DELETE FROM courseinformation WHERE id='". $e ."'");
			}
			echo '<script>alert("选中课程已删除。");</script>';
		}
		echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?page=showcourse\">";
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>已发布的课程</h3>
	<form action="showcourse.php" method="post">
		<table style="border:1px solid #99F;width:100%;">
			<tr style="background-color:#CCC;">
				<td style="width:24px;"><input style="display:none;" type="checkbox" name="chk[]" checked=1 /></td>
				<td>课程编号</td><td>课程名称</td><td>已选人数</td><td>限制人数</td>
				<td>上课时间</td><td>上课地点</td><td>上课周数</td><td>课程学分</td>
				<td>课程性质</td>
			</tr>
		<?php
			require "connectdatabase.php";
			$checklist = mysql_query("SELECT * FROM courseinformation WHERE teacherid='" . $user . "' ORDER BY id");
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
				echo '<td><input class="hideborder" type="checkbox" name="chk[]" value="' . $row['id'] . '" /></td>';
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
