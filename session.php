<?php include ('header.php') ?>


<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "<h1>Welcome To The Library,</h1>";
?>
</body>
</html>