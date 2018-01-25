<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	   if(isset($_POST["submitreport"])) {
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
		$sql = "create table if not exists report(rid int AUTO_INCREMENT primary key,rarea text,rtype varchar(200))";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}+
		    $rtype = '';
			if(isset($_POST["abusal"])) {
				$rtype = $_POST["abusal"];
				
			}
			//echo "<br>".$tag;
			$rarea = mysql_real_escape_string($_POST["rarea"]);
			
			//echo $qarea."<br>".$uid;
		$sql = "insert into report (rarea,rtype) values('$rarea','$rtype')";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
		
			header('Location: index.php');
		}
		
	?>
</body>
</html>