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
	  </script>
	    <link rel="stylesheet" href="css/style-custom.css"/>
		<title>Course Forum</title>
	  </head>
<body style="overflow-x: scroll">
        <div class="taskbar">
			<h1 id="title"><span>Course</span> <span style="font-family:helvetica;font-size:40px;">Forum</span></h1>
			 
			<div id="discussions">
			<span id="filterdiscussions" href="#" class="dropdown-button" data-activates='dropdown1'>Filter Discussions</span> <br>
			<i id="home" onclick="window.location.reload()" class="mdi-action-home medium"></i>
		    </div>
		<ul id='dropdown1' class='dropdown-content'>
    <li><a href="#" id="bytag">By Tag</a></li>
	<li class="divider"></li>
    <li><a href="#" id="byuser">By User</a></li>
  </ul>
		</div>
		
		<div class="row">
		<div class="col s2 l2 m2">
		<button id="que-btn" class="show-on-large-only btn btn-default blue"><i class="mdi-content-add"></i>Ask Question</button><br>
		</div>
  <!-- Modal Structure -->
    
    <div id="login1" class="modal" style="width: 500px; height: 500px;">
    <div class="modal-content">
      <h4>REPORT ABUSE</h4>
      <form action="report.php" method="post">
		<table border="0px">
			<tr><td>
			<div class="row">
			  <div class="input-field col s12">
				<textarea id="rarea" class="materialize-textarea" name="rarea" length="1200"></textarea>
				<label for="rarea">Describe abusal here</label>
			  </div>
			</div>
			<p>Abusal Type</p>
			<input type="radio" id="sexual" name="abusal" value="Sexual"/>
			  <label for="sexual">Sexual</label>&nbsp
			  <input type="radio" id="communal" name="abusal" value="Communal"/>
			  <label for="communal">Communal</label>&nbsp
			  <input type="radio" id="others" name="abusal" value="Others"/>
			  <label for="others">Others</label>  
			</td></tr> 
			  <tr>
			  <td><button class="btn waves-effect waves-light" type="submit" name="submitreport">report</button></td>
			  </tr>
			
		</table>
	  </form>
    </div>
  </div>

  <div id="ask" class="modal" style="width: 500px; height: 500px;">
    <div class="modal-content">
      <h4>Enter your question</h4>
      <form action="question.php" method="post">
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
			  <input id="uid" type="text" name="uid" class="validate">
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
      <form id="answer" action="answer.php" method="post">
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
			  <input id="uid" type="text" name="uid" class="validate">
			  <label for="uid">identify your post</label>
			  </div></td>
			  <td><button class="btn waves-effect waves-light" type="submit" name="submitreply">Post</button></td>
			  </tr>
			
		</table>
	  </form>
    </div>
  </div>  
  <div class="fixed-action-btn"  style="bottom: 5px; right: 24px;">
				<a  id="lg" class="btn-flat"><i class="mdi-content-flag right"></i>Report Abuse</a>
			 </div>
			 <script>
			 $("#lg").on("click",function(){
				$("#login1").openModal();
			});
			 </script>
		<div class="col s8 l8 m8" id="main_div">
		<div id="inner_div" class="row">
			 <div id="m_d" class="col s12 l12 m12">
			 <span id="disc_cnt" style="color: #009688;font-size: 30px;"><u>Discussion Center</u></span><br><br>
			 <?php 
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
		//mysqli_select_db("forum");
		
			 if(!mysqli_select_db($conn, "forum")) {
				die("Can't connect now...oops !!! <br> reason : ".mysqli_error($conn));
			 }
			 else if(mysqli_select_db($conn, "forum")){
			 $sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
			 $sql = "select * from questab";
			 $retval = mysqli_query($conn, $sql);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
			 }
			 $sql1="select * from anstab";
			 
			 if(mysqli_num_rows($retval)!=0){
			 while($row = mysqli_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysqli_query($conn, $sql1);
						 if($retval1){
						while($row1= mysqli_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'><p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p><pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre></div></div>";
							}
						}
						
						}
						
						else{
						//die("error".mysqli_error($conn));
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
		<div id="inner_div2" class="row">
			 <div id="m_d" class="col s12 l12 m12">
			 <span id="disc_cnt1" style="color: #009688;font-size: 30px;"><u>Discussion Center</u></span><br><br>
			 <?php 
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
		//mysqli_select_db("forum");
		
			 if(!mysqli_select_db($conn, "forum")) {
				die("Can't connect now...oops !!! <br> reason : ".mysqli_error($conn));
			 }
			 else if(mysqli_select_db($conn, "forum")){
			 $sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
			 $sql = "select * from questab where tags='Networking'";
			 $retval = mysqli_query($conn, $sql);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
			 }
			 $sql1="select * from anstab";
			 
			 if(mysqli_num_rows($retval)!=0){
			 while($row = mysqli_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysqli_query($conn, $sql1);
						 if($retval1){
						while($row1= mysqli_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'>";
								echo strip_tags("<p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p>","<b><p></p><br>");
								echo "<pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre></div></div>";
							}
						}
						
						}
						
						else{
						//die("error".mysqli_error($conn));
						}
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='postanswer(\"".$question."\",\"".$row['qid']."\")' class='badge waves-effect left'>Click to answer</span><pre class='right'><i class='mdi-social-person'>asked by ".$row['uid']."</i></pre></td></tr>";
						
						echo "</table>";
				}
				
				}
			
				$sql = "select * from questab where tags='Languages'";
			 $retval = mysqli_query($conn, $sql);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
			 }
			 $sql1="select * from anstab";
			 
			 if(mysqli_num_rows($retval)!=0){
			 while($row = mysqli_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysqli_query($conn, $sql1);
						 if($retval1){
						while($row1= mysqli_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'><p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p><pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre></div></div>";
							}
						}
						
						}
						
						else{
						//die("error".mysqli_error($conn));
						}
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='postanswer(\"".$question."\",\"".$row['qid']."\")' class='badge waves-effect left'>Click to answer</span><pre class='right'><i class='mdi-social-person'>asked by ".$row['uid']."</i></pre></td></tr>";
						
						echo "</table>";
				}
				
				}
			
				$sql = "select * from questab where tags='Database'";
			 $retval = mysqli_query($conn, $sql);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
			 }
			 $sql1="select * from anstab";
			 
			 if(mysqli_num_rows($retval)!=0){
			 while($row = mysqli_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysqli_query($conn, $sql1);
						 if($retval1){
						while($row1= mysqli_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'><p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p><pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre></div></div>";
							}
						}
						
						}
						
						else{
						//die("error".mysqli_error($conn));
						}
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='postanswer(\"".$question."\",\"".$row['qid']."\")' class='badge waves-effect left'>Click to answer</span><pre class='right'><i class='mdi-social-person'>asked by ".$row['uid']."</i></pre></td></tr>";
						
						echo "</table>";
				}
				
				}
			 }
			 ?>
			 </div>
		</div>
		
		<div id="inner_div3" class="row">
			 <div id="m_d" class="col s12 l12 m12">
			 <span id="disc_cnt3" style="color: #009688;font-size: 30px;"><u>Discussion Center</u></span><br><br>
			 <div id="namefilter" class="modal" style="width:750px;">
						<h4>Enter userid to filter by</h4>
						<form id="userfilter" action="index.php" method="post">
						<div class="input-field col s8">
						  <input id="uidfilter" type="text" name="uidfilter" class="validate">
						  <label for="uid">identify your post</label>
						  </div>
						  <button class="btn waves-effect waves-light" type="submit" name="submitfilter">Filter</button></td>
						  <a class=" modal-action modal-close waves-effect waves-green btn">Cancel</a>
						  
						  </form>
				   </div>
			 <?php 
			 if(isset($_POST['submitfilter'])) {
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
		//mysqli_select_db("forum");
		
			 if(!mysqli_select_db($conn, "forum")) {
				die("Can't connect now...oops !!! <br> reason : ".mysqli_error($conn));
			 }
			 else if(mysqli_select_db($conn, "forum")){
			 $sql = "create table if not exists questab (ques TEXT NOT NULL,qid int AUTO_INCREMENT primary key,tags varchar(100) NOT NULL,uid varchar(100) NOT NULL)";
		$retval = mysqli_query($conn, $sql);
		if(!$retval) {
			die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
		}
		
		     $userid = $_POST['uidfilter'];
			 $sql = "select * from questab where uid='$userid'";
			 $retval = mysqli_query($conn, $sql);
			 if(!$retval) {
				die("<h3>Oopsie some error....Visit Later</h3><br> reason : ".mysqli_error($conn));
			 }
			
			 $sql1="select * from anstab";
			 
			 if(mysqli_num_rows($retval)!=0){
			 while($row = mysqli_fetch_assoc($retval))
				{  
					$question = $row['ques'];
					echo "<table class='bordered '>".
					      "<tr><td class='que' >".$row['qid'].".".$question.
						 "<br><a class='badge'>Tags : {$row['tags']}</a>";
						 $retval1=mysqli_query($conn, $sql1);
						 if($retval1){
						while($row1= mysqli_fetch_assoc($retval1))
						{
							if($row1['qid']==$row['qid'])
							{
								echo "<br><div class='row'><div class='col s1'></div>"."<div class='col s11'><p style='padding-left:12px;border-left:2px solid red;font-family:helvetica;font-weight:600;'>".$row1['ans']. "</p><pre><i class='mdi-image-edit'>answered by ".$row1['uid']."</i></pre></div></div>";
							}
						}
						
						}
						
						else{
						//die("error".mysqli_error($conn));
						}
						echo "<br><span style='padding-top:19px;cursor:pointer;font-size:23px;' onclick='postanswer(\"".$question."\",\"".$row['qid']."\")' class='badge waves-effect left'>Click to answer</span><pre class='right'><i class='mdi-social-person'>asked by ".$row['uid']."</i></pre></td></tr>";
						
						echo "</table>";
				}
				
				}
			 }
			 }
			 ?>
			 </div>
		</div>
		</div>
		</div>
</body>
</html>