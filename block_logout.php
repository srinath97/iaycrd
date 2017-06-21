<?php
session_start();
unset($_SESSION['block_name']);
unset($_SESSION['district_name']);
header("refresh:0;url=block.php");
?>