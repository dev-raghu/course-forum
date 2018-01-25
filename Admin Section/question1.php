<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	   if(isset($_POST["submitque"])) {
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
		$sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
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
			$qarea = mysql_real_escape_string($_POST["qarea"]);
			$uid = mysql_real_escape_string($_POST["uid"]);
			//echo $qarea."<br>".$uid;
		$sql = "insert into questab (ques,tags,uid) values('$qarea','$tag','$uid')";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
		
			header('Location: admin.php');
		}
		
	?>
</body>
</html>