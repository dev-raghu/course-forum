<?php 
            if(isset($_POST['submitreport'])) {
				echo $_POST['mailid'];
				echo "<br>".$_GET['report'];

				$subject = 'ABUSAL REPORT';
				$message = $_GET['report'];
				$to = $_POST['mailid'];
				$type = 'plain'; // or HTML
				$charset = 'utf-8';

				$mail     = 'no-reply@'.str_replace('www.', '', $_SERVER['SERVER_NAME']);
				$uniqid   = md5(uniqid(time()));
				$headers  = 'From: '.$mail."\n";
				$headers .= 'Reply-to: '.$mail."\n";
				$headers .= 'Return-Path: '.$mail."\n";
				$headers .= 'Message-ID: <'.$uniqid.'@'.$_SERVER['SERVER_NAME'].">\n";
				$headers .= 'MIME-Version: 1.0'."\n";
				$headers .= 'Date: '.gmdate('D, d M Y H:i:s', time())."\n";
				$headers .= 'X-Priority: 3'."\n";
				$headers .= 'X-MSMail-Priority: Normal'."\n";
				$headers .= 'Content-Type: multipart/mixed;boundary="----------'.$uniqid.'"'."\n";
				$headers .= '------------'.$uniqid."\n";
				$headers .= 'Content-type: text/'.$type.';charset='.$charset.''."\n";
				$headers .= 'Content-transfer-encoding: 7bit';

				mail($to, $subject, $message, $headers);
				header('Location: admin.php');
			}?>