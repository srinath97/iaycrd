<DOCTYPE html>
<html>
	<?php
		session_start();
		if(isset($_SESSION['username']))
		{
			header("refresh:0,url=user.php");
		}
		$pass='';
	?>
	<head>
     <title>User Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name=’viewport’ />
		<meta name=”viewport” content=”width=device-width” />
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<body style="background-image:url(background.jpg)">
		<div class="container">
			<div class="info">
				<h1>Indira Awaas Yojana User Login</h1>
			</div>
		</div>
		<!--
         -->
		<div class="form">
			<div class="thumbnail"><img src="village.png" /></div>
			<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
				<div class="field1">
                    <div class="field-wrap">
						<select onchange="load()" class="district element select small" id="element_0" name="district" required="true" style="width:100%;height: 30px;margin-bottom:15px">  
							<option value="" selected="selected" disabled>Select District</option>
						<?php 
							require_once("db.php");
							$query="SELECT district FROM users GROUP BY district";
							$result=mysqli_query($stat,$query);
							while($rows=mysqli_fetch_array($result))
							{?>
								<option value="<?php echo $rows['district'] ?>"><?php echo $rows['district'] ?></option>		
								<?php	
							}
						?>
						</select>
						<script>
						function load()
						{
							var st=document.getElementById('element_0');
						    var district=st.options[st.selectedIndex].text;
						    $.get("block1.php?district="+district,function(data,status)
				            {
				               document.getElementById("elements_1").innerHTML=data;
			                });
			                document.getElementById("elements_2").innerHTML="";
						}

						</script>
						
						  	<div id="elements_1">
								<script>
									function load1()
									{
										var st=document.getElementById('element_0');
									    var district=st.options[st.selectedIndex].text;
									    var st1=document.getElementById('element_1');
									    var block=st1.options[st1.selectedIndex].text;
									    $.get("gp.php?district="+district+"&block="+block,function(data,status)
							            {
							               document.getElementById("elements_2").innerHTML=data;
						                });
									}
								</script>
							</div>
						  	<div id="elements_2">
							
							</div>
						
						
						
					</div>
				</div>
				<input type="password" placeholder="Password" name="pass" value="<?php echo $pass; ?>" required autocomplete="off">
				<p id="incor1"></p>
				<button name="submit1">Login</button>
			</form>
		</div>
		</body>
	</head>
	<?php
		if(isset($_POST['submit1']))
		{
		    $district=trim($_POST['district']);
		    $block=trim($_POST['block']);
		    $gp=trim($_POST['gp']);
		    $pass=$_POST['pass'];
		    include ('db.php');
		    $query="SELECT * from users WHERE district='$district' and block='$block' and gp='$gp'";
		    $result=mysqli_query($stat,$query);
		    $flag=0;
		    if($row=mysqli_fetch_array($result))
		    {
		    	if(($row['password']==""&&$pass==$gp)||$pass==$row['password'])
		    	{
		    		$flag=1;	
		    		$_SESSION['username']=$row['id'];
		    		echo "<meta http-equiv=\"refresh\" content=\"0;URL=user.php\">";
		    	}
		        
			}
		    function wrong()
		    {
		    		?>
		            <script >
		            document.getElementById("incor1").innerHTML="Incorrect username or password!!!";
		            </script>
		        	<?php 
		        	      // header("refresh:0,url=academylogin.php");
		    }
		    if($flag==0)
		    	wrong();

		}
	?>
	<script src="jquery-1.12.0.min.js"></script>
    <script src="jquery-migrate-1.2.1.min.js"></script>
    <script src="dd.js"></script>
    
</html>