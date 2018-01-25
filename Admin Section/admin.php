  <html>
<head>
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
	  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script src="js/jquery.scrollmagic.min.js"></script>
	  <script src="js/script-cus.js"></script>
	  <script>
		function postanswer(quest,quesid) {
		$("#question").html("Question "+quesid+" <br> "+quest);
		$("#reply").openModal();
		$('#answer').attr('action', function(i, value) {
			return value + "?&qid=" + quesid;
		});  
		}
		function submitreport(report) {
		
		$("#mailreport").openModal();
		$('#abreport').attr('action', function(i, value) {
			return value + "?&report=" + report;
		}); 
		}
		function delpost(ansid) {
		window.location.href="deletepost.php?&ansid="+ansid;
		}
	  </script>
	    <link rel="stylesheet" href="css/style-custom.css"/>
		<title>Course Forum</title>
	  </head>
<body style="overflow-x: scroll">
        <div class="taskbar">
			<h1 id="title"><span>Course</span> <span style="font-family:helvetica;font-size:40px;">Forum</span></h1>
			<i id="home" onclick="window.location.reload()" class="mdi-action-home medium"></i>
		</div>
		
		<div class="row">
		<div class="col s2 l2 m2">
		<button id="que-btn" class="show-on-large-only btn btn-default blue"><i class="mdi-content-add"></i>Ask Question</button><br>
		</div>
 <!-- Modal Structure -->
  <div id="ask" class="modal" style="width: 500px; height: 500px;">
    <div class="modal-content">
      <h4>Enter your question</h4>
      <form action="question1.php" method="post">
		<table border="0px">
			<tr><td>
			<div class="row">
			  <div class="input-field col s12">
				<textarea id="qarea" class="materialize-textarea" name="qarea" length="1200"></textarea>
				<label for="qarea">Enter your Question here</label>
			  </div>
			</div>
			</td></tr>
			 <p>Tags</p>
			 <input type="checkbox" id="nw" name="nw" value="Networking"/>
			  <label for="nw">Networking</label>&nbsp
			  <input type="checkbox" id="lang" name="lang" value="Languages"/>
			  <label for="lang">Languages</label>&nbsp
			  <input type="checkbox" id="db" name="db" value="Database"/>
			  <label for="db">Database</label>  
			  <tr><td><div class="input-field col s8">
			  <input id="uid" type="text" name="uid" class="validate" value="admin" readonly>
			  <label for="uid">identify your post</label>
			  </div></td>
			  <td><button class="btn waves-effect waves-light" type="submit" name="submitque">Ask</button></td>
			  </tr>
			
		</table>
	  </form>
    </div>
  </div>
    <div id="reply" class="modal" style="width: 500px; height: 500px;">
    <div class="modal-content">
      <h4>POST YOUR ANSWER</h4>
      <form id="answer" action="answer1.php" method="post">
		<table border="0px">
			<tr><td>
				<div id='question'></div>
			</td></tr>
			<tr><td>
			<div class="row">
			  <div class="input-field col s12">
				<textarea id="replyarea" class="materialize-textarea" name="replyarea" length="1200"></textarea>
				<label for="replyarea">Post your answer here</label>
			  </div>
			</div>
			</td></tr>  
			  <tr><td><div class="input-field col s8">
			  <input id="uid" type="text" name="uid" class="validate" value="admin" readonly>
			  <label for="uid">identify your post</label>
			  </div></td>
			  <td><button class="btn waves-effect waves-light" type="submit" name="submitreply">Post</button></td>
			  </tr>
			
		</table>
	  </form>
    </div>
  </div>  
   <div id="mailreport" class="modal">
    <div class="modal-content">
      <h4>MAIL ABUSAL REPORT</h4>
      <form id="abreport" action="mailreport.php" method="post">
		<table border="0px">  
			  <tr><td><div class="input-field col s8">
			  <input id="mailid" type="email" name="mailid" class="validate">
			  <label for="mailid">Enter Mail Address</label>
			  </div></td>
			  <td><button class="btn-flat waves-effect waves-light" type="submit" name="submitreport"> <i class="small mdi-content-send right"></i>SEND MAIL</button></td>
			  </tr>
			
		</table>
	  </form>
    </div>
  </div> 
  <div class="fixed-action-btn"  style="bottom: 5px; right: 24px;">
				<a  id="vbr" class="btn-flat"><i class="small right mdi-action-report-problem"></i>View Abusal Reports</a>
			 </div>
			 <script>
			 $("#lg").on("click",function(){
				window.location.href="index.php"
			});
			 </script>
		<div class="col s8 l8 m8" id="main_div">
		<div id="inner_div" class="row">
			 <div id="m_d" class="col s12 l12 m12">
			 <span id="disc_cnt" style="color: #009688;font-size: 30px;"><u>Discussion Center</u></span><br><br>
			 <?php 
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
		//mysql_select_db("forum");
		
			 if(!mysql_select_db("forum")) {
				die("Can't connect now...oops !!! <br> reason : ".mysql_error());
			 }
			 else if(mysql_select_db("forum")){
			 $sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
			 $sql = "select * from questab";
			 $retval = mysql_query($sql,$conn);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
			 }
			 $sql1="select * from anstab";
			 
			 if(mysql_num_rows($retval)!=0){
			 while($row = mysql_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysql_query($sql1,$conn);
						 if($retval1){
						while($row1= mysql_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'><p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p><pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='delpost(\"".$row1['aid']."\")' class='badge waves-effect left'>Delete Post</span></div></div>";
							   echo "";
							}
						}
						
						}
						
						else{
						//die("error".mysql_error());
						}
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='postanswer(\"".$question."\",\"".$row['qid']."\")' class='badge waves-effect left'>Click to answer</span><pre class='right'><i class='mdi-social-person'>asked by ".$row['uid']."</i></pre></td></tr>";
						
						echo "</table>";
				}
				
				}
				else
				{
				  ?><h3>Currently we do not have any live questions</h3>
				   <div id="err_box" class="modal" style="width:670px;">
						<h4>Currently we do not have any live questions</h4>
				   </div>
				   <script>
						$("#err_box").openModal();
				   </script>
				  <?php
				}
			 }
			 ?>
			 </div>
		</div>
			<div id="inner_div8" class="row">
			 <div id="m_d" class="col s12 l12 m12">
			 <span id="disc_cnt" style="color: #009688;font-size: 30px;"><u>Abusal Report Center</u></span><br><br>
			 <?php 
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
		//mysql_select_db("forum");
		
			 if(!mysql_select_db("forum")) {
				die("Can't connect now...oops !!! <br> reason : ".mysql_error());
			 }
			 else if(mysql_select_db("forum")){
			$sql = "create table if not exists report(rid int AUTO_INCREMENT primary key,rarea text,rtype varchar(200))";
		$retval = mysql_query($sql,$conn);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
		}
			 $sql = "select * from report";
			 $retval = mysql_query($sql,$conn);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysql_error());
			 }
			 
			 
			 if(mysql_num_rows($retval)!=0){
			 while($row = mysql_fetch_assoc($retval))
				{  
					echo "<table class='bordered '>".
					      "<tr><td class='rid' >".$row['rid'].".".$row['rarea'].
						 "<br><a class='badge'>Abusal Type : {$row['rtype']}</a>";
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='submitreport(\"".$row['rarea']."\")' class='badge waves-effect left'>Mail Abusal Report</span></td></tr>";
						
						echo "</table>";
				}
				
				}
				else
				{
				  ?><h3>Forum is Clean</h3>
				   <div id="err_box" class="modal" style="width:670px;">
						<h4>Forum is Clean Don't Worry</h4>
				   </div>
				   <script>
						$("#err_box").openModal();
				   </script>
				  <?php
				}
			 }
			 ?>
			 </div>
		</div>
		</div>
		</div>
</body>
</html>