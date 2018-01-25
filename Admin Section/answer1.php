<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	    if(isset($_POST['submitreply'])){
		$dbhost = "localhost:3306";
		$dbuser = "root";
		$dbpass = "root";
		$conn = mysql_connect($dbhost,$dbuser,$dbpass);
		if(!$conn) {
			die("Can't connect now...oops !!! <br> reason : ".mysql_error());
		}
		$sql = "create database if not exists forum";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
		mysql_select_db("forum");
		$sql = "create table if not exists anstab (ans TEXT NOT NULL,aid int AUTO_INCREMENT NOT NULL primary key,qid int NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
		$qid=$_GET["qid"];
		$ans=mysql_real_escape_string($_POST["replyarea"]);
		$uid=mysql_real_escape_string($_POST['uid']);
		$uid=mysql_real_escape_string($_POST['uid']);
		$sql="insert into anstab(ans,qid,uid) values('$ans','$qid','$uid')";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}  
		
			header('Location: admin.php');
		}
		
	?>
</body>
</html>