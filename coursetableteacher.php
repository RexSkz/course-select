<?php
	require "sessionstart.php";
	require "constants.php";
?>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<div id="main" style="line-height:28px;width:95%;">
	<h3>上课课表</h3>
	<table style="border:1px solid #99F;width:100%;">
		<tr style="background-color:#CCC;">
			<td style="width:60px;"></td>
			<td style="width:110px;">周一</td>
			<td style="width:110px;">周二</td>
			<td style="width:110px;">周三</td>
			<td style="width:110px;">周四</td>
			<td style="width:110px;">周五</td>
		</tr>
	<?php
		require "connectdatabase.php";
		$checklist = mysql_query("SELECT * FROM courseinformation WHERE teacherid='" . $user . "'");
		$a = array("一" => 1, "二" => 2, "三" => 3, "四" => 4, "五" => 5);
		for ($i = 1; $i <= 5; ++$i) {
			for ($j = 1; $j <= 5; ++$j) {
				$v[$i][$j] = NULL;
			}
		}
		while ($row = mysql_fetch_array($checklist)) {
			$time = $row['time'];
			$detail = explode("<br />", $time);
			$day = $th = "";
			foreach ($detail as $e) {
				$day = substr($e, 3, 3);
				$th = substr($e, 9, 1);
				if ($v[$th][$a[$day]] != NULL) {
					$v[$th][$a[$day]] .= "<br />";
				}
				$v[$th][$a[$day]] .= $row['name'] . "<br />" . $row['place'] . "<br />" . $row['week'] .
				"<br />(" . $row['selectedNumber'] . "/" . $row['capacity'] . ")";
			}
		}
		for ($i = 0; $i < 5; ++$i) {
			if ($i % 2 == 1) {
				$highlight = " style=\"background-color:#DDD;\"";
			}
			else {
				$highlight = " style=\"background-color:#EEE;\"";
			}
			echo "<tr" . $highlight . ">";
			echo "<td>第" . ($i + 1) . "节</td>";
			for ($j = 0; $j < 5; ++$j) {
				echo "<td>";
				if ($v[$i + 1][$j + 1] != NULL) {
					echo $v[$i + 1][$j + 1];
				}
				echo "</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
	<br /><br />
</div>
