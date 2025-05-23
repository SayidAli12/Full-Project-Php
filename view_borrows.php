<?php include('header.php')?>

<?php
include('Conection.php');
$update_query = "UPDATE borrows SET status='unreturned' WHERE date < CURDATE() AND status != 'returned'";
$mysqli->query($update_query);

// Fetch all records from the borrows table
$result = $mysqli->query("SELECT * FROM borrows");

	$result = $mysqli->query("SELECT br.*, s.student_name, s.address , s.contact, s.Faculty, b.book_name , b.edition , b.category  from borrows br   
		inner join books b on br.book_id = b.id   
		inner join students  s on br.Student_id = s.id")

or die(mysqli_error($mysqli));


?>

<!DOCTYPE html>
<html>
<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            transition: background-color 0.5s ease;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #deepskyblue;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card h3 {
            color: #007bff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover, .btn-danger:hover {
            opacity: 0.8;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table tfoot {
            background-color: #007bff;
            color: #fff;
        }
        .alert {
            margin-top: 20px;
        }
        .btn-primary {
            transition: transform 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.1);
        }
        .btn-danger {
            transition: transform 0.3s ease;
        }
        .btn-danger:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <center>
                <h3>Borrows</h3>
            </center>
            <br>
            <?php if (isset($_SESSION['update_msg'])): ?>
                <script>
                    Swal.fire({
                        title: 'Updated!',
                        text: '<?php echo $_SESSION['update_msg']; ?>',
                        icon: 'success',
                        timer: 1000, // Duration in milliseconds (3000ms = 3 seconds)
                        timerProgressBar: true // Show a progress bar with the timer
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('The alert was closed by the timer');
                        }
                    });
                </script>
                <?php unset($_SESSION['update_msg']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['save_msg'])): ?>
                <script>
                    Swal.fire({
                        title: 'Saved!',
                        text: '<?php echo $_SESSION['save_msg']; ?>',
                        icon: 'success',
                        timer: 1000, // Duration in milliseconds (3000ms = 3 seconds)
                        timerProgressBar: true // Show a progress bar with the timer
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('The alert was closed by the timer');
                        }
                    });
                </script>
                <?php unset($_SESSION['save_msg']); ?>
            <?php endif; ?>


            <?php if (isset($_SESSION['delete_msg'])): ?>
                <script>
                    Swal.fire({
                        title: 'deleted!',
                        text: '<?php echo $_SESSION['delete_msg']; ?>',
                        icon: 'success',
                        timer: 1000, // Duration in milliseconds (3000ms = 3 seconds)
                        timerProgressBar: true // Show a progress bar with the timer
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('The alert was closed by the timer');
                        }
                    });
                </script>
                <?php unset($_SESSION['delete_msg']); ?>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
                <a class="btn btn-primary rounded-pill" href="Add_Borrow.php"><i class="fa-solid fa-circle-plus"></i> <span>&nbsp;&nbsp;Add</span></a>
            </div>
            <br>
            <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered table-hover align-items-center">
                    <thead>
                    <tr class="bg-primary text-light">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Faculty</th>
                        <th>Book name</th>
                        <th>Edition</th>
                        <th>Category</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <?php
                        // Check if the status is not returned
                        $is_not_returned = $row['status'] !== 'returned';

                        // Check if the return date has passed
                        $return_date = strtotime($row['date']);
                        $today = strtotime(date('Y-m-d'));
                        $is_overdue = $return_date < $today;
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['Faculty']; ?></td>
                            <td><?php echo $row['book_name']; ?></td>
                            <td><?php echo $row['edition']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td <?php if ($is_not_returned && $is_overdue) echo 'style="color: red;"'; ?>><?php echo $row['time']; ?></td>
                            <td <?php if ($is_not_returned && $is_overdue) echo 'style="color: red;"'; ?>><?php echo $row['date']; ?></td>
                            <td <?php if ($is_not_returned && $is_overdue) echo 'style="color: red;"'; ?>>
                                <?php if ($is_not_returned && $is_overdue): ?>
                                    unreturned
                                <?php else: ?>
                                    <?php echo $row['status']; ?>
                                <?php endif ?>
                            </td>
                            <!-- Inside the table body, modify the 'Return' column -->
                            <td>
                                <?php if ($row['status'] !== 'returned'): ?>
                                    <a href="process/process_borrows.php?return=<?php echo $row['id']; ?>" class="Return btn btn-sm btn-success rounded-pill" style="width: 120px;">
                                        <i class="fa-solid fa-check-circle"></i>&nbsp;&nbsp;Return
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-success rounded-pill" disabled>Returned</button>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="process/process_borrows.php?delete=<?php echo $row['id'] ?>" class="Delete btn btn-sm btn-danger rounded-pill" style="width: 100px; background-color: #dc3545; color: #fff;">
                                    <i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                    <tr class="bg-primary">
                        <td colspan="13"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mytable').DataTable({
            order: [0, 'desc'],
            dom: 'Bfrtip',
            buttons: [
                'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Nothing found - sorry",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });

        // SweetAlert2 for Delete Button
        $('.Delete').click(function(event) {
            event.preventDefault();
            var deleteUrl = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });

        // SweetAlert2 for Return Button
        $('.Return').click(function(event) {
            event.preventDefault();
            var returnUrl = $(this).attr('href');
            Swal.fire({
                title: 'Confirm Return',
                text: "Are you sure you want to mark this book as returned?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = returnUrl;
                }
            });
        });
    });
</script>


</html>



<?php include('footer.php')?>