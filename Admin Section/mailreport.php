<?php 
            if(isset($_POST['submitreport'])) {
			echo $_POST['mailid'];
			echo "<br>".$_GET['report'];
			mail($_POST['mailid'],"BVBCSE ABUSAL REPORT",$_GET['report']);
			header('Location: admin.php');
			}?>