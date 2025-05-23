<?php
include('header.php');
include('Conection.php');
$date1 = isset($_POST['date1']) ? $_POST['date1'] : '';
$date2 = isset($_POST['date2']) ? $_POST['date2'] : '';
$result = null; // Initialize $result variable outside the if block

if (isset($_POST['generate'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

  $result = $mysqli->query("SELECT * from borrows  join books on borrows.book_id = books.id 
join students on borrows.Student_id = students.id where borrows.status = 'returned' and time between '$date1' and '$date2'") or die(mysqli_error($mysqli));
} elseif (isset($_POST['clear'])) {
    $date1 = '';
    $date2 = '';
}

// SQL query to count rows where status is 'returned'
// SQL query to count rows where status is 'returned' and time is between date1 and date2
$sql1 = "SELECT COUNT(id) AS returned FROM borrows WHERE status = 'returned' AND time BETWEEN '$date1' AND '$date2'";

// Execute the query
$result1 = $mysqli->query($sql1);

// Check if query was successful
if ($result1) {
    // Fetch the result1 row as an associative array
    $row1 = $result1->fetch_assoc();
    
    // Access the count value
    if (isset($date1) && isset($date2)) {
        $returned = $row1['returned'];
    } else {
        $returned = "0";
    }
}


?>
<div class="container">
    <div class="row">
        <div class="col">
        	<!-- switch buttons -->
        	<div class="card p-1">
        		<div class="col p-1">
        			<a href="available.php"><button class="btn p-1 m-2 btn-primary text-light">Available Books</button></a>
        			<a href="returned.php"><button class="btn p-1 m-2 btn-success text-light">Returned Books
                        &nbsp;:&nbsp;<?php echo $returned; ?></button></a>
	        		<a href="pending.php"><button class="btn p-1 m-2 btn-warning text-dark">Pending Books</button></a>
	        		<a href="unreturned.php"><button class="btn p-1 m-2 btn-danger text-light">Unreurned Books</button></a>
        		</div>
        	</div>


            <!-- date  range  -->
            <div class="card mb-3 mt-2">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12 col-lg-5">
                            <input type="date" name="date1" class="form-control" value="<?php echo $date1; ?>" required>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <input type="date" name="date2" class="form-control" value="<?php echo $date2; ?>" required>
                        </div>
                        <div class="col-sm-12 col-lg-1" style="float: right;">
                            <button type="submit" name="generate" class="btn btn-primary text-light">Generate</button>
                        </div>
                        <div class="col-sm-12 col-lg-1" style="float: right;">
                            <button type="submit" name="clear" class="btn btn-danger text-light">Clear</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- report -->
            <div class="card">
                <div class="card-header">BORROWED BOOKS REPORT</div>

                <div class="card-body">
                    <table id="mytable" class="table table-striped table-bordered">
                        <thead>
                            <tr class="bg-success text-light">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Book name</th>
                                <th>Edition</th>
                                <th>Time</th>
                                <th>Faculty</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['contact']; ?></td>
                                        <td><?php echo $row['book_name']; ?></td>
                                        <td><?php echo $row['edition']; ?></td>
                                        <td><?php echo $row['time']; ?></td>
                                        <td><?php echo $row['Faculty']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <?php 
										    if ($row['status'] == 'pending') {
										        echo "<td class='text-warning font-size-bold'>" . $row['status'] . "</td>";
										    } else if ($row['status'] == 'returned') {
										        echo "<td class='text-success font-size-bold'>" . $row['status'] . "</td>";
										    } else if ($row['status'] == 'unreturned') {
										        echo "<td class='text-success font-size-bold'>" . $row['status'] . "</td>";
										    }
										?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        <?php endif; ?>
                        <tfoot>
                            <tr class="bg-success">
                                <td colspan="14"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
