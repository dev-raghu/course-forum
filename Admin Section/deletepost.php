<?php 
$ansid=$_GET['ansid'];
echo $ans;


		$dbhost = "localhost:3306";
		$dbuser = "root";
		$dbpass = "";
		$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
		if(!$conn) {
			die("Can't connect now...oops !!! <br> reason : ".mysqli_error($conn));
		}
		$sql = "create database if not exists forum";
		$retval = mysqli_query($conn,$sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		mysqli_select_db($conn, "forum");
		$sql = "delete from anstab where aid='$ansid'";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
			header('Location: admin.php');
?>