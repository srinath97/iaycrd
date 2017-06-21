<DOCTYPE html>
<html>
	<?php
        $flag=0;
		session_start();
    if(isset($_SESSION['block_name'])&&isset($_SESSION['district_name']))
	{
	     header("refresh:0;url=block_index.php");
	}
	?>
     <?php

     if(isset($_POST['submit1']))
     {
   $block=$_POST['block'];
   $district=$_POST['district'];
   $pass=trim($_POST['pass']);
   if($pass==$block."123")
     {
	 header("refresh:0;url=block_index.php");
	 $_SESSION['district_name']=$district;
	 $_SESSION['block_name']=$block;
	 }
   else
     $flag=1;
     }   	
	?>
	<head>
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
		<title>Block Login</title>
		
		<body style="background-image:url(background.jpg)">
		<div class="container">
			<div class="info">
				<h1>IAYCRD Block Login</h1>
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
						}

						</script>
						
						  	<div id="elements_1">
							
							</div>
						
						
						
					</div>
				</div>
				<input type="password" placeholder="Password" name="pass" value="<?php echo $pass; ?>" required autocomplete="off">
				<p id="incor1"><?php
                                                      if($flag==1)
                                                            echo "Incorrect password!";
                                               ?></p>
				<button name="submit1">Login</button>
			</form>
		</div>
		</body>
	</head>
	
	<script src="jquery-1.12.0.min.js"></script>
    <script src="jquery-migrate-1.2.1.min.js"></script>
    <script src="dd.js"></script>
    
</html>