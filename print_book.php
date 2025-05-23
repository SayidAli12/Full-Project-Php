<?php include ('header.php') ?>

<body onyload="window.print()"   >

<?php  
$server= 'localhost';
$user= 'root';
$password= '';
$database= 'php';

$mysqli=new mysqli($server,$user,$password,$database) or die(mysqli_error($mysqli));

$id = $_GET['print'];

$result = $mysqli->query("SELECT * FROM books where id = '$id'
	") or die (mysqli_error($mysqli));

$row = $result->fetch_array();


?>
<div class="container">

	<center>
		<h1>Burao Library Management</h1>
		<h1>Print Books</h1>
	</center>
	


<h5>student ID: <?php echo $row["id"]; ?></h5>
<h5>Name: <?php echo $row["book_name"]; ?></h5>
<h5>gender: <?php echo $row["edition"]; ?></h5>
<h5>shift: <?php echo $row["category"]; ?></h5>
<h5>address: <?php echo $row["number"]; ?></h5>
<h5>contact: <?php echo $row["qty"]; ?></h5>
</div>


</div>


<?php include ('footer.php') ?>