<html>
<body>
<?php
session_start();

unset($_SESSION['username']);
header("refresh:0;url=index.php");
?>
</body>
</html>
