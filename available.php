<?php
include('header.php');

include('Conection.php');
$result = $mysqli->query("
    SELECT * from books ")
or die(mysqli_error($mysqli));



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Books Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .btn-group {
            display: flex;
            justify-content: center;
            background-image: url(D.png);
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
                            <i class="fas fa-book"></i>&nbsp;Available Books&nbsp;:&nbsp;<span id="available">0</span>
                        </a>
                        <a href="returned.php" class="btn btn-success m-2">
                            <i class="fas fa-undo-alt"></i>&nbsp;Returned Books
                        </a>
                        <a href="pending.php" class="btn btn-warning m-2">
                            <i class="fas fa-hourglass-half"></i>&nbsp;Pending Books
                        </a>
                        <a href="unreturned.php" class="btn btn-danger m-2">
                            <i class="fas fa-times-circle"></i>&nbsp;Unreturned Books
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- report -->
        <div class="row justify-content-center">
            <div class="card animate__animated animate__fadeIn">
                <div class="card-header">AVAILABLE BOOKS REPORT</div>
                <div class="card-body">
                    <table id="mytable" class="table table-striped table-bordered">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>ID</th>
                                <th>Book name</th>
                                <th>Edition</th>
                                <th>Category</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <?php if ($row['qty'] > 0): ?>
                                        <tr class="animate__animated animate__fadeIn">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php endwhile; ?>
                            </tbody>
                        <?php endif; ?>
                        <tfoot>
                            <tr class="bg-primary">
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get all the quantity cells
            var qtyCells = document.querySelectorAll("#mytable tbody tr td:nth-child(5)");
            
            // Initialize total quantity
            var totalQty = 0;
            
            // Loop through each quantity cell and sum up the values
            qtyCells.forEach(function (cell) {
                totalQty += parseInt(cell.textContent);
            });
            
            // Update the content of the span with id "available" with the total quantity without decimals
            document.getElementById("available").textContent = Math.floor(totalQty);
        });

</script>
<?php include('footer.php'); ?>
