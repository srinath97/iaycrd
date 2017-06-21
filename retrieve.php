<?php
session_start();
if(isset($_SESSION['admin_name']))
{
   require_once("db.php");
    
   if(isset($_GET['district']))
   {?>
   <select name="block" id="block" class="form-control" style="width:300px;display:inline;">
   <?php
     $district=$_GET['district'];  
     $query="SELECT block from users WHERE district='$district' GROUP BY district,block";
     $result=mysqli_query($stat,$query);
     while($row=mysqli_fetch_array($result))
     {?>
       <option><?php echo $row['block'];?></option>
     <?php
     }
	 ?>
	</select>
	<button name="submit" id="submit" type="submit" class="btn btn-default">Load data</button><br/><br/>
	<?php
   }
}
else
{
  header("refresh:0;url=admin.php");
}
?>