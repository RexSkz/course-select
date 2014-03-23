<?php
	require "connectdatabase.php";
	$queryline = mysql_query("SELECT * FROM teacherinformation WHERE id='" . $user . "'");
	$queryline = mysql_fetch_array($queryline);
	$name = $queryline['name'];
	$id = $queryline['id'];
	$dept = $queryline['dept'];
	$positionaltitle = $queryline['positionaltitle'];
?>
<div id="info">
	<h3>教师用户</h3>
	<table>
		<tr>
			<td style="width:50px;font-weight:bold;">姓名</td>
			<td style="width:120px;" id="name"><?php echo $name; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">工号</td>
			<td style="width:120px;" id="id"><?php echo $id; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">院系</td>
			<td style="width:120px;" id="dept"><?php echo $dept; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">职称</td>
			<td style="width:120px;" id="positionaltitle"><?php echo $positionaltitle; ?></td>
		</tr>
	</table>
	<br />
</div>
<ul>
	<li><a href="index.php?page=releasecourse">发布课程</a></li>
	<li><a href="index.php?page=showcourse">查看课程</a></li>
	<li><a href="index.php?page=coursetableteacher">上课课表</a></li>
	<li><a href="index.php?page=studentscore">学生成绩</a></li>
	<li><a href="index.php?page=changepassword&type=teacher">修改密码</a></li>
	<li><a href="logout.php">退出系统</a></li>
</ul>
