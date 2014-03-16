<?php
	require "sessionstart.php";
	require "constants.php";
	echo '<meta charset="utf-8" />';
	if (isset($_POST['id'])) {
		require "connectdatabase.php";
		$checklist = mysql_query("SELECT name FROM teacherinformation WHERE id='" . $user . "'");
		$checklist = mysql_fetch_array($checklist);
		$id = $_POST['id'];
		$name = $_POST['name'];
		$teacher = $checklist['name'];
		$teacherid = $user;
		$capacity = $_POST['capacity'];
		$chk = $_POST['chk'];
		$time = "";
		foreach ($chk as $e) {
			if ($time == "") {
				$time = $e;
			}
			else {
				$time .= "<br />" . $e;
			}
		}
		$place = $_POST['place'];
		$week = $_POST['week'];
		$credit = $_POST['credit'];
		$resume = $_POST['resume'];
		$comp = $_POST['comp'];
		mysql_query("INSERT INTO courseinformation VALUES (
			'" . $id . "', '" . $name . "', '" . $teacher . "', '" . $teacherid . "', '0',
			'" . $capacity . "', '" . $time . "', '" . $place . "', '" . $week . "', '" .
			$credit . "', '" . $resume . "', '" . $comp . "');"
		);
		echo '<script>alert("添加课程成功！");</script>';
		echo '<meta http-equiv="refresh" content="0; url=index.php?page=releasecourse">';
		die("");
	}
?>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;">
	<h3>发布课程</h3>
	<form action="releasecourse.php" method="post">
		<table>
			<tr>
				<td style="width:100px;">课程编号</td>
				<td><input class="text" name="id" type="text" style="width:250px;" /></td>
			</tr>
			<tr>
				<td style="width:100px;">课程名称</td>
				<td><input class="text" name="name" type="text" style="width:250px;" /></td>
			</tr>
			<tr>
				<td style="width:100px;">限制人数</td>
				<td><input class="text" name="capacity" type="text" style="width:250px;" /></td>
			</tr>
			<tr>
				<td style="width:100px;">上课时间</td>
				<td>
					<table style="border:1px solid #AAA;width:100%;">
						<tr style="background-color:#CCC;">
							<td></td><td>周一</td><td>周二</td><td>周三</td><td>周四</td><td>周五</td>
						</tr>
						<?php
						$k = 0;
						$a = array("一", "二", "三", "四", "五");
						for ($i = 0; $i < 5; ++$i) {
							$k++;
							if ($k % 2 == 0) {
								$hightlight = " style=\"background-color:#DDD;\"";
							}
							else {
								$hightlight = " style=\"background-color:#EEE;\"";
							}
							echo "<tr" . $hightlight . ">";
							echo "<td>第" . ($i + 1) . "节</td>";
							for ($j = 0; $j < 5; ++$j) {
								echo '<td>';
								echo '<input class="hideborder" name="chk[]" type="checkbox" value="周' . $a[$j] . '第' . ($i + 1) . '节" />';
								echo '</td>';
							}
							echo "</tr>";
						}
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width:100px;">上课周数</td>
				<td><input class="text" name="week" type="text" style="width:250px;" placeholder='请用"-"和","描述区间，例如 1-5,7,13-18' /></td>
			</tr>
			<tr>
				<td style="width:100px;">上课地点</td>
				<td><input class="text" name="place" type="text" style="width:250px;" /></td>
			</tr>
			<tr>
				<td style="width:100px;">课程学分</td>
				<td><input class="text" name="credit" type="text" style="width:250px;" /></td>
			</tr>
			<tr>
				<td style="width:100px;">课程简介</td>
				<td><textarea class="text" name="resume" placeholder="对该门课程的介绍" style="margin-top:5px;width:250px;height:100px;overflow:auto;"></textarea></td>
			</tr>
			<tr>
				<td style="width:100px;">课程性质</td>
				<td>
					<input type="radio" class="hideborder" name="comp" value="1" checked=1 />必修&nbsp;
					<input type="radio" class="hideborder" name="comp" value="0" />选修
				</td>
			</tr>
		</table>
		<p>
			<input style="width:60px;" class="button" value="提交" type="submit" />
			<input style="width:60px;" class="button" value="重置" type="reset" />
		</p>
	</form>
	<br />
</div>
