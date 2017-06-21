<?php
session_start();
unset($_SESSION['admin_name']);
header("refresh:0;url=admin.php");
?>