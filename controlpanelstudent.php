<?php
	require "connectdatabase.php";
	$queryline = mysql_query("SELECT * FROM studentinformation WHERE id='" . $user . "'");
	$queryline = mysql_fetch_array($queryline);
	$name = $queryline['name'];
	$id = $queryline['id'];
	$class = $queryline['class'];
	$dept = $queryline['dept'];
	$major = $queryline['major'];
?>
<div id="info">
	<h3>学生用户</h3>
	<table>
		<tr>
			<td style="width:50px;font-weight:bold;">姓名</td>
			<td style="width:120px;" id="name"><?php echo $name; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">学号</td>
			<td style="width:120px;" id="id"><?php echo $id; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">班级</td>
			<td style="width:120px;" id="class"><?php echo $class; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">院系</td>
			<td style="width:120px;" id="dept"><?php echo $dept; ?></td>
		</tr>
		<tr>
			<td style="width:50px;font-weight:bold;">专业</td>
			<td style="width:120px;" id="major"><?php echo $major; ?></td>
		</tr>
	</table>
	<br />
</div>
<ul>
	<li><a href="index.php?page=selectcourse">进入选课</a></li>
	<li><a href="index.php?page=selectedcourse">已选课程</a></li>
	<li><a href="index.php?page=coursetablestudent">我的课表</a></li>
	<li><a href="index.php?page=myscore">我的成绩</a></li>
	<li><a href="index.php?page=changepassword&type=student">修改密码</a></li>
	<li><a href="logout.php">退出系统</a></li>
</ul>
