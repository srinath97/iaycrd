<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Form</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


</head>
<body id="main_body" style="background-image:url(background.jpg)">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin interface</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<?php
		session_start();
		if(!isset($_SESSION['username']))
		{
				header("refresh:0,url=index.php");
		}
		else
		{
			?>
			<img id="top" src="top.png" alt="">
			<div id="form_container">
			
				<h1><a>Survey Form</a></h1>
				<p align="right" style="padding-right:20px"><a href="logoutuser.php">Log Out</a></p>
				<form id="form_1142271" class="appnitro" onsubmit="return confirm1();" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
				<div class="form_description">
				<ul>
				<?php
				$id=$_SESSION['username'];
				require_once('db.php');
				$query="SELECT * FROM users WHERE id='$id'";
				$result=mysqli_query($stat,$query);
				if($rows=mysqli_fetch_array($result))
				{
					$spillover=$rows['spillover'];
					$district=$rows['district'];
					$block=$rows['block'];
					$gp=$rows['gp'];
					if($rows['flag1']==false)
					{
						?>
						<h2>Login Details</h2>
							<b>District : </b><?php echo $rows['district'] ?>
							<b>Block : </b><?php echo $rows['block'] ?>
							<b>Grampanchayat : </b><?php echo $rows['gp'] ?>
						</div>
						<li id="li_1" >
							<label class="description" for="element_1">Employer Name </label>
							<div>
								<input id="element_1" name="element_1" class="element text small" type="text" maxlength="255"  required value=""/> 
							</div> 
						</li>			
						<li id="li_2" >
							<label class="description" for="element_2">Employer Designation </label>
							<div>
								<input id="element_2" name="element_2" class="element text small" type="text" maxlength="255"  required value=""/> 
							</div> 
						</li>		
						<li id="li_3" >
							<label class="description" for="element_3">New Pasword </label>
							<div>
								<input id="element_3" name="element_3" class="element text small" type="password" minlength=6 maxlength="255"  required value=""/> 
							</div> 
						</li>
						<li id="li_4" >
							<label class="description" for="element_4">Retype New Pasword </label>
							<div>
								<input id="element_4" name="element_4" class="element text small" type="password" maxlength="255"  required value=""/> 
							</div> 
						</li>
						<li class="buttons">
							<input type="hidden" name="form_id" value="1142271" />
							<button class="btn btn-success" type="submit" name="submit1" >Next</button>
						</li>
					<?php
					}
					else if($rows['flag2']==false)
					{
						?>
						<h2>Village Details</h2>
							<b>District : </b><?php echo $rows['district'] ?>
							<b>Block : </b><?php echo $rows['block'] ?>
							<b>Grampanchayat : </b><?php echo $rows['gp'] ?>
						</div>						
						<li id="li_5" >
							<label class="description" for="element_5">Spillover </label>
							<div>
								<input id="element_5" name="element_5" class="element small" type="number" min="0"  required value="0"/> 
							</div> 
						</li>			
						<li id="li_6" >
							<label class="description" for="element_6">Completed House </label>
							<div>
								<input id="element_6" name="element_6" class="element small" type="number" min="0"  required value="0"/> 
							</div> 
						</li>		
						<li id="li_7" >
							<label class="description" for="element_7">Pending House </label>
							<div>
								<input id="element_7" name="element_7" class="element small" type="number" readonly min="0"  required value="0"/> 
							</div> 
						</li>
						<li>
							<p id="incor1"></p>
						</li>
						<li class="buttons">
							<input type="hidden" name="form_id" value="1142271" />
							<button class="btn btn-success" type="submit" name="submit2" >Submit</button>
						</li>

					<?php
					}
					else
					{
						?>
						<h2>Survey Details</h2>
							<b>District : </b><?php echo $rows['district'] ?>
							<b>Block : </b><?php echo $rows['block'] ?>
							<b>Grampanchayat : </b><?php echo $rows['gp'] ?>
						</div>	
						<?php
							date_default_timezone_set('Asia/Kolkata');
							$da=date('Y-m-d');
							$day=date('D');
							$query="SELECT * FROM survey WHERE date='$da' and district='$district' and block='$block' and gp='$gp'";
							$result=mysqli_query($stat,$query);
							if(mysqli_num_rows($result)==0)
							{	
							?>
							<li id="li_8" >
								<label class="description" for="element_8">Plinth Level </label>
								<div>
									<input id="element_8" name="element_8" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>			
							<li id="li_9" >
								<label class="description" for="element_9">Lintel Level </label>
								<div>
									<input id="element_9" name="element_9" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>		
							<li id="li_10" >
								<label class="description" for="element_10">Roof Level </label>
								<div>
									<input id="element_10" name="element_10" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>
							<li id="li_11" >
								<label class="description" for="element_11">Cancelled </label>
								<div>
									<input id="element_11" name="element_11" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>
							<li id="li_12" >
								<label class="description" for="element_12">Not Started </label>
								<div>
									<input id="element_12" name="element_12" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>
							<li id="li_13">
								<label class="description" for="element_13">Pending </label>
								<div>
									<input id="element_13" name="element_13" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>
							<li id="li_14">
								<label class="description" for="element_14">Completed </label>
								<div>
									<input id="element_14" name="element_14" class="element small" type="number" min="0"  required value=""/> 
								</div> 
							</li>
							<li>
								<p id="incor1"></p>
							</li>
							<li class="buttons">
								<input type="hidden" name="form_id" value="1142271" />
								<button class="btn btn-success" type="submit" name="submit3" >Submit</button>
							</li>

						<?php
						}
						else
						{
							echo "Survey Filled for today. Please Visit tomorrow.";
						}
					}
				}
			?>
			
				</ul>
			</form>	
			<?php
				if(isset($_POST['submit1']))
				{
				    $name=trim($_POST['element_1']);
				    $empdes=trim($_POST['element_2']);
				    $pass1=trim($_POST['element_3']);
				    $pass2=trim($_POST['element_4']);
				    include ('db.php');
				    $flag=0;
				    if($pass1==$pass2)
			    	{
			    		$flag=1;
			    		$query="UPDATE users set password='$pass1',name='$name',empdes='$empdes',flag1=true WHERE id='$id'";
						$result=mysqli_query($stat,$query);
			    		echo "<meta http-equiv=\"refresh\" content=\"0;URL=user.php\">";
			    	}
				    function wrong()
				    {
				    		?>
				            <script>
				            alert("Password does not match!!!");
				            </script>
				        	<?php 
				        	      // header("refresh:0,url=academylogin.php");
				    }
				    if($flag==0)
				    	wrong();
				}
				else if(isset($_POST['submit2']))
				{
				    $spillover=trim($_POST['element_5']);
				    $complete=trim($_POST['element_6']);
				    $pending=trim($_POST['element_7']);
				    include ('db.php');
				    $flag=1;
		    		$query="UPDATE users set spillover='$spillover',completed='$complete',pending='$pending',flag2=true WHERE id='$id'";
					$result=mysqli_query($stat,$query);
					function succ()
				    {
				    		?>
				            <script>
				            alert("Details Successfully Stored!!");
				            </script>
				        	<?php 
				    }
				    succ();
		    		echo "<meta http-equiv=\"refresh\" content=\"0;URL=user.php\">";
				}
				else if(isset($_POST['submit3']))
				{
				    $plinth=trim($_POST['element_8']);
				    $lintel=trim($_POST['element_9']);
				    $roof=trim($_POST['element_10']);
				    $cancel=trim($_POST['element_11']);
				    $notstart=trim($_POST['element_12']);
				    $incomplete=trim($_POST['element_13']);
				    $complete=trim($_POST['element_14']);
				    include ('db.php');
				    $flag=1;
		    		$query="SELECT * FROM survey WHERE id='2'and district='$district' and block='$block' and gp='$gp'";
					$result=mysqli_query($stat,$query);
					if(mysqli_num_rows($result)!=0)
					{
			    		$query="DELETE FROM survey WHERE id='1'and district='$district' and block='$block' and gp='$gp'";
						$result=mysqli_query($stat,$query);
						$query="UPDATE survey set id='1' WHERE id='2'and district='$district' and block='$block' and gp='$gp'";
						$result=mysqli_query($stat,$query);
					}
					$query="SELECT * FROM survey WHERE id='1'and district='$district' and block='$block' and gp='$gp'";
					$result=mysqli_query($stat,$query);
					if(mysqli_num_rows($result)==0)
					{
						$i=1;
					}
					else
					{
						$i=2;
					}
		    		$query="INSERT INTO `survey`(`id`, `district`, `block`, `gp`, `plinth`, `lintel`, `roof`, `cancelled`, `notstart`, `pending`,`completed`, `date`) VALUES ('$i','$district','$block','$gp','$plinth','$lintel','$roof','$cancel','$notstart','$incomplete','$complete','$da')";
					$result=mysqli_query($stat,$query);
					$pend=$spillover-$complete;
					$query="UPDATE `users` set completed='$complete',pending='$pend' WHERE id='$id'";
					$result=mysqli_query($stat,$query);
					if($day=="Mon")
					{
						$query="SELECT * FROM weekly WHERE id='2'and district='$district' and block='$block' and gp='$gp'";
						$result=mysqli_query($stat,$query);
						if(mysqli_num_rows($result)!=0)
						{
				    		$query="DELETE FROM weekly WHERE id='1'and district='$district' and block='$block' and gp='$gp'";
							$result=mysqli_query($stat,$query);
							$query="UPDATE weekly set id='1' WHERE id='2'and district='$district' and block='$block' and gp='$gp'";
							$result=mysqli_query($stat,$query);
						}
						$query="SELECT * FROM weekly WHERE id='1'and district='$district' and block='$block' and gp='$gp'";
						$result=mysqli_query($stat,$query);
						if(mysqli_num_rows($result)==0)
						{
							$i=1;
						}
						else
						{
							$i=2;
						}
			    		$query="INSERT INTO `weekly`(`id`, `district`, `block`, `gp`, `plinth`, `lintel`, `roof`, `cancelled`, `notstart`,`pending`,`completed`,`date`) VALUES ('$i','$district','$block','$gp','$plinth','$lintel','$roof','$cancel','$notstart','$incomplete','$complete','$da')";
						$result=mysqli_query($stat,$query);
					}
					function succ()
				    {
				    		?>
				            <script>
				            alert("Details Successfully Stored!!");
				            </script>
				        	<?php 
				    }
				    succ();
		    		echo "<meta http-equiv=\"refresh\" content=\"0;URL=user.php\">";
				}
			?>
			<div id="footer">
			</div>
		</div>
		<img id="bottom" src="bottom.png" alt="">
		<?php
		}
	?>
	</body>
	<script type="text/javascript">
		function confirm1()
		{
			if(confirm("Are you sure you want to submit the details?"))
				return true;
			else
				return false;
		}
	</script>
	<script src="jquery-1.12.0.min.js"></script>
    <script src="jquery-migrate-1.2.1.min.js"></script>
    <script src="dd.js"></script>
    
</html>
