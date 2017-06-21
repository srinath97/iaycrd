<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['admin_name']))
{
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
                        <h1 class="page-header">Defaulters</h1>
                    </div>
				<p>List</p>
				
				    <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>District</th>
											<th>Block</th>
											<th>GP</th>
											<th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									if(isset($_GET['page']))
									   $page=$_GET['page'];
									else
									  $page=1;
									  $start_from=($page-1)*200;
                                     require_once("db.php");
									  $query="SELECT * FROM users ORDER by id ASC LIMIT $start_from,200";
									  $result=mysqli_query($stat,$query);
									  $i=1;
									  while($row=mysqli_fetch_array($result))
									  {
									    $dist=$row['district'];
										$block=$row['block'];
										$gp=$row['gp'];
									    date_default_timezone_set('Asia/Kolkata');
										$date=date('Y-m-d');
										$query1="SELECT * FROM survey WHERE district='$dist' && block='$block' && gp='$gp' && date='$date'";
										$result1=mysqli_query($stat,$query1);
										if(mysqli_num_rows($result1)==0)
										{?>
										    <tr>
											<td>
											<?php echo $i; $i++; ?>
											</td>
											<td>
											<?php echo $row['district'];?>
											</td>
											<td>
											<?php echo $row['block'];?>
											</td>
											<td>
											<?php echo $row['gp'];?>
											</td>
											<td>
											<?php echo $row['name'];?>
											</td>
											</tr>
										<?php
										}
									  }
									  
									?>
									
									 
                                    </tbody>
                                </table>
								
                    </div>
					<?php
					if($i==1)
						 echo "No records found.";
				    if($i!=1)
					{
					 echo "<h4>Pages</h4>";
					$query="SELECT COUNT(id) FROM users";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$records=$row[0];
					$records=ceil($records/200);
					if(!isset($_GET['page']))

					   $page=1;
					else
					   $page=$_GET['page'];
					for($j=1;$j<$records;$j++)
					{
					   if($j==$page)
					   {?>
					   <b><u>
					   <?php
					   }
					   echo "<a href='admin_index.php?page=".$j."'>".$j."</a>";
					   if($j==$page)
					   {?>
					   </b></u>
					    <?php
					   }
					   echo " | ";
					}
					}
					?>
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
