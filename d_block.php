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
                        <h1 class="page-header">Block wise statistics</h1>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<select onchange="load()" name="district" id="type" class="form-control" style="width:300px;display:inline;">
					<option disabled selected>SELECT DISTRICT</option>
                        <?php
						require_once("db.php");
						$query="SELECT district FROM users GROUP BY district";
						$result=mysqli_query($stat,$query);
						while($row=mysqli_fetch_array($result))
						{
						?>
						
						<option><?php echo $row['district'];?></option>
						<?php
						}?>
                    </select>
					<div id="sel" style="display:inline"></div>
					
					<script>
					
					function load()
					{
						var st=document.getElementById('type');
					    var district=st.options[st.selectedIndex].text;
					 $.get("retrieve.php?district="+district,function(data,status)
		             {
		               document.getElementById("sel").innerHTML=data;
	                 });
					}
					</script>
					 
					</form>
				<?php
				if(isset($_POST['submit']))
				{
				   $district=$_POST['district'];
				   $block=$_POST['block'];
                   echo "<h2>Displaying data for ".$_POST['block']."</h2>";
				    $query="SELECT id FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$flag1=1;
					if(mysqli_num_rows($result)==0)
					{
					$flag1=0;
					}
				    $query="SELECT id FROM survey WHERE id='2' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
			        $flag=1;
			        $id=2;
					if(mysqli_num_rows($result)==0)
					{
						$id=1;
						$flag=0;
					}
					//for id 1
					if($flag1==1)
					{
					$query="SELECT SUM(spillover) AS spillover FROM users WHERE district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$spillover=$row['spillover'];
					
	                $query="SELECT SUM(completed) AS completed FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$completed=$row['completed'];
					
					$district=$_POST['district'];
				    $query="SELECT SUM(plinth) AS plinth_level FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$plinth=$row['plinth_level'];
					
					$query="SELECT SUM(lintel) AS lintel_level FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$lintel=$row['lintel_level'];
					
					$query="SELECT SUM(roof) AS roof_level FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$roof=$row['roof_level'];
					
					$query="SELECT SUM(cancelled) AS cancelled FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$cancelled=$row['cancelled'];
					
					$query="SELECT SUM(pending) AS pending FROM survey WHERE id='$id' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$pending=$row['pending'];
					}
					else 
					  echo "<br/><b>No records found</b>";
					//for id 2
					
					if($flag1!=0)
					{?>
					<h4>Total</h4>
					 <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
										    <th>Spillover</th>
											<th>Completed</th>
                                            <th>Plinth level</th>
											<th>Lintel level</th>
											<th>Roof level</th>
											<th>Cancelled</th>
											<th>Pending</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<tr>
									<td><?php echo $spillover;?>
                                    </td>
									<td><?php echo $completed;?>
                                    </td>
									<td><?php echo $plinth;?>
                                    </td>
							        <td><?php echo $lintel;?>
                                    </td>
							        <td><?php echo $roof;?>
                                    </td>
									<td><?php echo $cancelled;?>
                                    </td>
									<td><?php echo $pending;?>
                                    </td>
									</tr>
                                    </tbody>
                                </table>
								
                    </div>
					<?php
					}
					if($flag==1)
					{
				    $district=$_POST['district'];
				    $query="SELECT SUM(plinth) AS plinth_level FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$plinth=$row['plinth_level']-$plinth;

					$query="SELECT SUM(completed) AS completed FROM survey WHERE id='1' && district='$district'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$completed=$row['completed']-$completed;

					$query="SELECT SUM(lintel) AS lintel_level FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$lintel=$row['lintel_level']-$lintel;
					
					$query="SELECT SUM(roof) AS roof_level FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$roof=$row['roof_level']-$roof;
					
					$query="SELECT SUM(cancelled) AS cancelled FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$cancelled=$row['cancelled']-$cancelled;
					
					$query="SELECT SUM(pending) AS pending FROM survey WHERE id='1' && district='$district' && block='$block'";
					$result=mysqli_query($stat,$query);
					$row=mysqli_fetch_array($result);
					$pending=$row['pending']-$pending;
					}
					if($flag1!=0)
					{
						$x=1;
						if($id==2)
							$x=-1;
					?>
					<h4>Today's progress</h4>
				    <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Plinth level</th>
											<th>Lintel level</th>
											<th>Roof level</th>
											<th>Cancelled</th>
											<th>Pending</th>
											<th>Completed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<tr>
									<td><?php echo $x*$plinth;?>
                                    </td>
							        <td><?php echo $x*$lintel;?>
                                    </td>
							        <td><?php echo $x*$roof;?>
                                    </td>
									<td><?php echo $x*$cancelled;?>
                                    </td>
									<td><?php echo $x*$pending;?>
                                    </td>
                                    <td><?php echo $x*$completed;?>
                                    </td>
									</tr>
                                    </tbody>
                                </table>
								
                    </div>
					<?php
				    }
				}
				?>
				
				
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
