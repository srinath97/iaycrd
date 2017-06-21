<?php
session_start();
if(!isset($_SESSION['username']))
{
   
   require_once("db.php");
    
   if(isset($_GET['district'])&&isset($_GET['block']))
   {?>
     <select class="gp element select small" name="gp" required="true" style="width:100%;height: 30px;margin-bottom:15px"> 
     <option value="" selected="selected" disabled>Select Grampanchayat</option>
     <?php
        $district=$_GET['district'];  
        $block=$_GET['block']; 
        $query="SELECT gp from users WHERE district='$district' and block='$block'";
        $result=mysqli_query($stat,$query);
        while($row=mysqli_fetch_array($result))
        {?>
           <option><?php echo $row['gp'];?></option>
        <?php
        }
  	 ?>
  	 </select>  
  	
  	<?php
   }
}
else
{
  header("refresh:0;url=users.php");
}
?>