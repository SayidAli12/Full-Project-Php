<?php include('header.php')?>
<?php 
if ($_SESSION['role']!='Admin'){

	header('location: index.php');
}

 ?>

	
<?php
include('Conection.php');

$result = $mysqli->query("
	SELECT *from users ")
or die(mysqli_error($mysqli));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Form</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <div class="card">
    <div class="card-body">
    <center>
        
        <h3 style="color: #007bff;">Users</h3>
    </center>

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
           
    <a style="width:150px; background-color: #007bff;" class="btn btn-primary rounded-pill" href="Add_user.php"><i class="fa-solid fa-circle-plus"></i> <span>&nbsp;&nbsp;Add</span></a>
    <br><br>
    <table id="mytable" class="table table-striped table-bordered">
        <thead>
            <tr class="bg-primary text-light">
                <th>ID</th>
                <th>User Name</th>
                <th>Password</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><a href="edit_user.php?edit=<?php echo $row['user_id']; ?>" style="width: 100px; background-color: #007bff; color: #fff;" class="btn btn-sm btn-primary rounded-pill"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Update</a></td>
                    <td><a href="process/process_user.php?delete=<?php echo $row['user_id']; ?>" class="Delete btn btn-sm btn-danger rounded-pill" style="width: 100px; background-color: #dc3545; color: #fff;"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr class="bg-primary">
                <td colspan="7"></td>
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
            var deleteUrl = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        });
    });
</script>
</body>
</html>

<?php include('footer.php')?>