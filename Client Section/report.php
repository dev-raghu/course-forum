<!DOCTYPE html>
<head>
	<title>Course Forum</title>
</head>
<body>
	<?php
	   if(isset($_POST["submitreport"])) {
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
		$sql = "create table if not exists report(rid int AUTO_INCREMENT primary key,rarea text,rtype varchar(200))";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}+
		    $rtype = '';
			if(isset($_POST["abusal"])) {
				$rtype = $_POST["abusal"];
				
			}
			//echo "<br>".$tag;
			$rarea = $_POST["rarea"];
			
			//echo $qarea."<br>".$uid;
		$sql = "insert into report (rarea,rtype) values('$rarea','$rtype')";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		
			header('Location: index.php');
		}
		
	?>
</body>
</html>