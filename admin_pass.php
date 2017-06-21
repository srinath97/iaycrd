<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['admin_name']))
{
    $length_flag=0;
    $mismatch_flag=0;
    $exceeded=0;
    $incorrect=0;
   if(isset($_POST['submit']))
   {
      require_once("db.php");
	  $old=$_POST['old'];
      $name=$_SESSION['admin_name'];
      $pass=trim($_POST['pass']);
	  $pass1=trim($_POST['pass1']);
      $q="SELECT pass FROM admin";
	  $result=mysqli_query($stat,$q);
	  $row=mysqli_fetch_array($result);
	  if(strlen($pass)>16)
	{
	   $exceeded=1;
	}
	if(crypt($old,$row['pass'])!=$row['pass'])
	{
	   $incorrect=1;
	}
	if(strlen($pass)<6)
	{
	   $length_flag=1;
	}
	if(strcmp($pass,$pass1)!=0)
	{
	  $mismatch_flag=1;
	}
	if(($length_flag!=1)&&($mismatch_flag!=1)&&($incorrect!=1)&&($exceeded!=1))
	{
	    $blowfish_salt=bin2hex(openssl_random_pseudo_bytes(22));
                                                $hash=crypt($pass,"$2a$12$".$blowfish_salt);
                                                $query="UPDATE `admin` SET `pass`= '$hash'";    
                                                $result=mysqli_query($stat,$query);
                                                echo "
                                                    <script >
                                                    alert('Password Changed!');
                                                    </script>
                                                ";
	
	}
   }
?>
<html lang="en">
<head>

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin_index.php">Admin interface</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="admin_pass.php"><i class="fa fa-gear fa-fw"></i> Change password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="admin_logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
						<li class="active">
                            <a href="admin_index.php"><i class="fa fa-table fa-fw"></i> Defaulters</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i>Daily Statistics<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="d_district.php">District wise</a>
                                </li>
                                <li>
                                    <a href="d_block.php">Block wise</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i>Weekly Statistics<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="w_district.php">District wise</a>
                                </li>
                                <li>
                                    <a href="w_block.php">Block wise</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
				    <h2>Change password</h2>
					
					<?php
					if($length_flag==1||$mismatch_flag==1||$incorrect==1||$exceeded==1)
					{?>
					<p style="color:red">The following errors were found while changing the password:</p>
					<ul style="color:red">
					<?php
					if($incorrect==1)
					   echo "<li>Old passwords do not match!</li>";
					if($exceeded==1)
					   echo "<li>Password cannot be longer than 16 characters!</li>";
					if($mismatch_flag==1)
					   echo "<li>Please re-enter the passwords. The entered passwords do not match!</li>";
					if($length_flag==1)
					   echo "<li>Password must be atleast 6 characters</li>";
					}
					?>
					</ul>
				
                      <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
					<br/>
					<label>Enter old password</label>
					<input type="password" maxlength='16' style="width:250px;" name="old" class="form-control">
					<br/>
					<label>Enter new password</label>
					<input type="password" maxlength='16' style="width:250px;" name="pass" class="form-control">
					<br/>
					<label>Re-enter new password</label>
					<input type="password" maxlength='16' style="width:250px;" name="pass1" class="form-control">
					<br/>
					 <button name="submit" id="submit" type="submit" class="btn btn-lg btn-warning">Change password</button>	
					</div>
              
               </form>			
                    </div>
				    
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>
<?php
}
else
{
   header("refresh:0;url=admin.php");
}
?>
</html>
