<?php 
$ansid=$_GET['ansid'];
echo $ans;


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
		$sql = "delete from anstab where aid='$ansid'";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
			header('Location: admin.php');
?>