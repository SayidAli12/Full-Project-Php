<?php include('header.php')?>
<?php 
if ($_SESSION['role']!='Admin'){
	header('location: index.php');
}

 ?>
<?php
include('Conection.php');
$result = $mysqli->query("
	SELECT *from contact ")
or die(mysqli_error($mysqli));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Form</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons JS -->
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            margin-top: 50px;
        }
        .btn-primary, .btn-danger {
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;

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
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <center>
                <h3 style="color: #007bff;">Feedback</h3>
            </center>

            <?php if (isset($_SESSION['update_msg'])): ?>
                <script>
                    Swal.fire({
                        title: 'Updated!',
                        text: '<?php echo $_SESSION['update_msg']; ?>',
                        icon: 'success',
                        timer: 1000, // Duration in milliseconds (1000ms = 1 second)
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
                        timer: 1000, // Duration in milliseconds (1000ms = 1 second)
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
                        title: 'Deleted!',
                        text: '<?php echo $_SESSION['delete_msg']; ?>',
                        icon: 'success',
                        timer: 1000, // Duration in milliseconds (1000ms = 1 second)
                        timerProgressBar: true // Show a progress bar with the timer
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('The alert was closed by the timer');
                        }
                    });
                </script>
                <?php unset($_SESSION['delete_msg']); ?>
            <?php endif; ?>

            <br><br>
            <table id="mytable" class="table table-striped table-bordered">
                <thead>
                <tr class="bg-primary text-light">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['your_name']; ?></td>
                        <td><?php echo $row['your_email']; ?></td>
                        <td>
                            <button class="show-full-message btn btn-sm btn-primary rounded-pill" data-message="<?php echo htmlspecialchars($row['your_massage']); ?>">View Message</button>
                        </td>
                        <td>
                            <a href="process/process_students.php?delete=<?php echo $row['id']; ?>" class="Delete btn btn-sm btn-danger rounded-pill">
                                <i class="fas fa-trash"></i>&nbsp;&nbsp;Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
                <tfoot>
                <tr class="bg-primary">
                    <td colspan="5"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#mytable').DataTable({
            order: [0, 'desc'],
            dom: 'Bfrtip',
            buttons: [
                'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ]
        });

        $('.Delete').click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
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
                    window.location.href = url;
                }
            });
        });

        $('.show-full-message').click(function() {
            var message = $(this).data('message');

            Swal.fire({
                title: 'Message',
                html: message,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    });
</script>
</body>
</html>


<?php include('footer.php')?>