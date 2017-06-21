<?php
   require_once("db.php");
    
   if(isset($_GET['district']))
   {?>
     <select class="block element select small" onchange="load1()" id="element_1" name="block" required="true" style="width:100%;height: 30px;margin-bottom:15px">
     <option value="" selected="selected" disabled>Select Block</option>
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
  	
  	<?php
   }
?>