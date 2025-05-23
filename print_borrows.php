<?php include ('header.php') ?>

<body onload="window.print()"   >

<?php  
$server= 'localhost';
$user= 'root';
$password= '';
$database= 'php';

$mysqli=new mysqli($server,$user,$password,$database) or die(mysqli_error($mysqli));

$id = $_GET['print'];

$result = $mysqli->query("SELECT * FROM borrows where id = '$id'
	") or die (mysqli_error($mysqli));

$row = $result->fetch_array();


?>
<div class="container">

	<center>
		<h1>Burao Library Management</h1>
		<h1>Print Borrows</h1>
	</center>
	

<h5>Student ID: <?php echo $row["id"]; ?></h5>
<h5>Name: <?php echo $row["student_id"]; ?></h5>
<h5>Payment: <?php echo $row["book_id"]; ?></h5>
<h5>Blance: <?php echo $row["time"]; ?></h5>
<h5>Payment: <?php echo $row["date"]; ?></h5>


</div>
</body>
<?php include ('footer.php') ?>