<?php include ('header.php') ?>

<?php
include('Conection.php');
if ($mysqli->connect_error) {
die('not connected');
}
else {
	
	echo "";
}
?>
<center>
<h1> Library Managnment System</h1>
</center>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css"
 href="css/jquery.dataTables.min.css">
 
 <script src="js/jquery.js"></script>
 
<script src="js/jquery.dataTables.min.js"></script>
</head>



<?php include('footer.php')?>