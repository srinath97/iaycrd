<?php
	require_once('db.php');
	$q="DELETE from survey WHERE 1;";
	$re=mysqli_query($stat,$q);
	$q="DELETE from weekly WHERE 1;";
	$re=mysqli_query($stat,$q);
	$q="UPDATE users set password='',name='',empdes='',spillover=0,completed=0,pending=0,flag1=false,flag2=false WHERE 1;";
	$re=mysqli_query($stat,$q);
	$q="alter table survey AUTO_INCREMENT =1 ;";
	$re=mysqli_query($stat,$q);
	$q="alter table weekly AUTO_INCREMENT =1 ;";
	$re=mysqli_query($stat,$q);
	echo "The database was reset!!";
?>