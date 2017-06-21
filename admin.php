<!DOCTYPE html>
<html>
<?php
    if(isset($_SESSION['admin_name']))
	{
	     header("refresh:0;url=admin_index.php");
	}
?>
  <head>
  <style>#err{color:red;}</style>
  <?php
  session_start();
if(isset($_SESSION['admin_name']))
{
  header("refresh:0;url=admin_index.php");
}
$flag=-1;
if(isset($_POST['submit']))
{
  $flag=0;
   $name=trim($_POST['name']);
   $pass=trim($_POST['pass']);
  require_once("db.php");
  $query="SELECT * FROM admin";
  $result=mysqli_query($stat,$query);
  while($row=mysqli_fetch_array($result))
  {  
   if(!strcasecmp($name,$row['name']))
   {
     if(crypt($_POST['pass'],$row['pass'])==$row['pass'])
     {
      $flag=1;
      $_SESSION['admin_name']=$name;
      header("refresh:0;url=admin_index.php");
     }
   }
  }
 
}
	 ?>
    <meta charset="UTF-8">
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

    <title>Admin login
	</title>
    
    
    <link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body style="background-image: url('background.jpg')";
<div class="pen-title">
  <h1>Admin login</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div><i class="fa fa-times fa-pencil"></i>
  </div>
  <div class="form">
   
    <h2>Login to your account</h2>
    <p id="err"><?php 
if($flag==0)
echo "Incorrect name/password";
?>
</p>
<br/>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<b>Name:&nbsp&nbsp</b><input type="name" name="name">
<b>Password:</b><input type="password" name="pass">
<input type="submit" name="submit"><br/><br/>
</form>
	
  </div>
 
</div>
   
    
    
    
  </body>
</html>
