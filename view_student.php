<?php include('header.php')?>

<?php
include('Conection.php');
$result = $mysqli->query("
	SELECT *from students ")
or die(mysqli_error($mysqli));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
            border: none;
        }
        .btn-primary:hover, .btn-danger:hover {
            opacity: 0.8;
        }
        .table thead, .table tfoot {
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
            <center><h3 style="color: #007bff;">Students</h3></center>
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
                <a style="width:150px;" class="btn btn-primary rounded-pill" href="Add_Students.php"><i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add</a>
            </div>
            <br><br>
            <table id="mytable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Faculty</th>
                        <th>Semester</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['student_name'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['Faculty'] ?></td>
                            <td><?php echo $row['semester'] ?></td>
                            <td>
                                <a href="edit_students.php?edit=<?php echo $row['id']; ?>" style="width: 100px; background-color: #007bff; color: #fff;" class="btn btn-sm btn-primary rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Update
                                </a>
                            </td>
                            <td>
                                <a href="process/process_students.php?delete=<?php echo $row['id']; ?>" style="width: 100px; background-color: #dc3545; color: #fff;" class="Delete btn btn-sm btn-danger rounded-pill">
                                    <i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9"></td>
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
    });
</script>
</body>
</html>

<?php include('footer.php')?>