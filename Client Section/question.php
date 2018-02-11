<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	   if(isset($_POST["submitque"])) {
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
		$sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		    $tag = '';
			if(isset($_POST["nw"])) {
				$tag = $tag.$_POST["nw"];
				
			}
			if(isset($_POST["lang"])) {
				$tag = $tag.$_POST["lang"];
			}
			if(isset($_POST["db"])) {
				$tag = $tag.$_POST["db"];
			}
			//echo "<br>".$tag;
			$qarea = $_POST["qarea"];
			$uid = $_POST["uid"];
			//echo $qarea."<br>".$uid;
		$sql = "insert into questab (ques,tags,uid) values('$qarea','$tag','$uid')";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		
			header('Location: index.php');
		}
		
	?>
</body>
</html>