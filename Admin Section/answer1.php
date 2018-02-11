<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	    if(isset($_POST['submitreply'])){
		$dbhost = "localhost:3306";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
		if(!$conn) {
			die("Can't connect now...oops !!! <br> reason : ".mysqli_error($conn));
		}
		$sql = "create database if not exists forum";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		mysqli_select_db($conn, "forum");
		$sql = "create table if not exists anstab (ans TEXT NOT NULL,aid int AUTO_INCREMENT NOT NULL primary key,qid int NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		$qid=$_GET["qid"];
		$ans=($_POST["replyarea"]);
		$uid=($_POST['uid']);
		$uid=($_POST['uid']);
		$sql="insert into anstab(ans,qid,uid) values('$ans','$qid','$uid')";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}  
		
			header('Location: index.php');
		}
		
	?>
</body>
</html>