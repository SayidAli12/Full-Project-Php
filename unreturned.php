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
join students on borrows.Student_id = students.id where borrows.status = 'unreturned' and time between '$date1' and '$date2'") or die(mysqli_error($mysqli));
} elseif (isset($_POST['clear'])) {
    $date1 = '';
    $date2 = '';
}

// SQL query to count rows where status is 'returned'
// SQL query to count rows where status is 'returned' and time is between date1 and date2
$sql1 = "SELECT COUNT(id) AS unreturned FROM borrows WHERE status = 'unreturned' AND time BETWEEN '$date1' AND '$date2'";

// Execute the query
$result1 = $mysqli->query($sql1);

// Check if query was successful
if ($result1) {
    // Fetch the result1 row as an associative array
    $row1 = $result1->fetch_assoc();
    
    // Access the count value
    if (isset($date1) && isset($date2)) {
        $unreturned = $row1['unreturned'];
    } else {
        $unreturned = "0";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Books Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .btn-group {
            display: flex;
            justify-content: center;
            background-image: url(c.jfif);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            width: 120px;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col p-4">
                <!-- Switch buttons -->
                <div class="card p-1 mb-2 animate__animated animate__fadeIn">
                    <div class="btn-group">
                        <a href="available.php" class="btn btn-primary m-2">
                            <i class="fas fa-book"></i>&nbsp;Available Books
                        </a>
                        <a href="returned.php" class="btn btn-success m-2">
                            <i class="fas fa-undo-alt"></i>&nbsp;Returned Books
                        </a>
                        <a href="pending.php" class="btn btn-warning m-2">
                            <i class="fas fa-hourglass-half"></i>&nbsp;Pending Books
                        </a>
                        <a href="unreturned.php" class="btn btn-danger m-2">
                            <i class="fas fa-times-circle"></i>&nbsp;Unreturned Books&nbsp;:&nbsp;<?php echo $unreturned; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- date range -->
        <div class="row justify-content-center">
            <div class="col-sm-15 col-lg-7">
                <div class="card mb-3 animate__animated animate__fadeIn">
                    <form method="post">
                        <div class="row">
                            <div class="col">
                                <input type="date" name="date1" class="form-control" value="<?php echo $date1; ?>" required>
                            </div>
                            <div class="col">
                                <input type="date" name="date2" class="form-control" value="<?php echo $date2; ?>" required>
                            </div>
                            <div class="col">
                                <button type="submit" name="generate" class="btn btn-primary">
                                    <i class="fas fa-cog"></i>&nbsp;Generate
                                </button>
                            </div>
                            <div class="col">
                                <button type="submit" name="clear" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>&nbsp;Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- report -->
        <div class="row justify-content-center">
            <div class="col">
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-header">UNRETURNED BOOKS REPORT</div>
                    <div class="card-body">
                        <table id="mytable" class="table table>
                        <table id="mytable class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg-danger text-light">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Book Name</th>
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
                                <tr class="animate__animated animate__fadeIn">
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['book_name']; ?></td>
                                    <td><?php echo $row['edition']; ?></td>
                                    <td><?php echo $row['time']; ?></td>
                                    <td><?php echo $row['Faculty']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td>
                                        <?php
                                            if ($row['status'] == 'pending') {
                                                echo "<span class='text-warning font-weight-bold'>" . $row['status'] . "</span>";
                                            } else if ($row['status'] == 'returned') {
                                                echo "<span class='text-success font-weight-bold'>" . $row['status'] . "</span>";
                                            } else if ($row['status'] == 'unreturned') {
                                                echo "<span class='text-danger font-weight-bold'>" . $row['status'] . "</span>";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <?php endif; ?>
                            <tfoot>
                                <tr class="bg-danger">
                                    <td colspan="10"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable').DataTable({
                order: [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            });
        });
    </script>

</body>

</html>

<?php include('footer.php'); ?>
