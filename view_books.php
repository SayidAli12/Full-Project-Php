<?php include('header.php')?>

	<?php
include('Conection.php');
$result = $mysqli->query("
	SELECT *from books ")
or die(mysqli_error($mysqli));




// Assuming you have a mysqli connection established in $mysqli

// Get count of books for each category
$categories = ['Social Science', 'Technology', 'Accounting', 'Medicine', 'Law', 'Other'];
$counts = [];

foreach ($categories as $category) {
    $stmt = $mysqli->prepare("SELECT COUNT(*) as count FROM books WHERE category = ?");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $counts[$category] = $row['count'];
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for alignment and buttons */
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .btn-group {
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
        .btn-group button {
            margin: 0 5px;
        }
        .card-header {
            background-color: #007bff; /* Primary blue */
            color: white;
        }
        .card-body {
            background-color: white;
        }
        .table-container {
            margin-top: 20px;
        }
        .btn-rounded {
            border-radius: 20px !important;
            padding: 8px 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <center><h3 style="color: #007bff;">Books Management</h3></center>
            <br>

            <!-- PHP Session Messages -->
            <?php if (isset($_SESSION['update_msg'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Updated!',
                            text: '<?php echo $_SESSION['update_msg']; ?>',
                            icon: 'success',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(function() {
                            window.location.href = window.location.href.split('?')[0];
                        });
                    });
                </script>
                <?php unset($_SESSION['update_msg']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['save_msg'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Saved!',
                            text: '<?php echo $_SESSION['save_msg']; ?>',
                            icon: 'success',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(function() {
                            window.location.href = window.location.href.split('?')[0];
                        });
                    });
                </script>
                <?php unset($_SESSION['save_msg']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['delete_msg'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Deleted!',
                            text: '<?php echo $_SESSION['delete_msg']; ?>',
                            icon: 'success',
                            timer: 1000,
                            timerProgressBar: true
                        }).then(function() {
                            window.location.href = window.location.href.split('?')[0];
                        });
                    });
                </script>
                <?php unset($_SESSION['delete_msg']); ?>
            <?php endif; ?>

            <!-- Add New Book Button -->
            <a class="btn btn-primary btn-rounded mb-4" href="Books.php">
                <i class="fas fa-plus-circle"></i> <span>Add New Book</span>
            </a>

            <!-- Button Group for Categories -->
            <div class="btn-group mb-4">
                <button onclick="showTable('socialScienceTable')" class="btn btn-primary">
                    <i class="fas fa-book"></i> Social Science
                    <span id="SocialScienceCount">: <?php echo $counts['Social Science']; ?></span>
                </button>
                <button onclick="showTable('technologyTable')" class="btn btn-success">
                    <i class="fas fa-laptop"></i> Technology
                    <span id="TechnologyCount">: <?php echo $counts['Technology']; ?></span>
                </button>
                <button onclick="showTable('accountingTable')" class="btn btn-warning">
                    <i class="fas fa-calculator"></i> Accounting
                    <span id="AccountingCount">: <?php echo $counts['Accounting']; ?></span>
                </button>
                <button onclick="showTable('medicineTable')" class="btn btn-danger">
                    <i class="fas fa-ambulance"></i> Medicine
                    <span id="MedicineCount">: <?php echo $counts['Medicine']; ?></span>
                </button>
                <button onclick="showTable('LawTable')" class="btn btn-info">
                    <i class="fas fa-balance-scale"></i> Law
                    <span id="LawCount">: <?php echo $counts['Law']; ?></span>
                </button>
                <button onclick="showTable('OtherTable')" class="btn btn-secondary">
                    <i class="fas fa-book-open"></i> Others
                    <span id="OtherCount">: <?php echo $counts['Other']; ?></span>
                </button>
            </div>

            <!-- Tables for Each Category -->
            <div id="tables">
                <!-- Social Science Table -->
                <div id="socialScienceTable" class="table-container">
                    <div class="card bg-primary">
                        <div class="card-header bg-primary">
                            <h5 class="m-0">Social Science Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- PHP Query Loop -->
                                    <?php
                                    $socialScienceQuery = "SELECT * FROM books WHERE category='Social Science' LIMIT 30";
                                    $socialScienceResult = $mysqli->query($socialScienceQuery);
                                    while ($row = $socialScienceResult->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
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
                
                <!-- Technology Table -->
                <div id="technologyTable" class="table-container" style="display:none;">
                    <div class="card bg-success">
                        <div class="card-header bg-success">
                            <h5 class="m-0">Technology Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-success text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $technologyQuery = "SELECT * FROM books WHERE category='Technology' LIMIT 10";
                                    $technologyResult = $mysqli->query($technologyQuery);
                                    while ($row = $technologyResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-success btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-success">
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Accounting Table -->
                <div id="accountingTable" class="table-container" style="display:none;">
                    <div class="card bg-warning">
                        <div class="card-header bg-warning">
                            <h5 class="m-0">Accounting Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-warning text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $accountingQuery = "SELECT * FROM books WHERE category='Accounting' LIMIT 10";
                                    $accountingResult = $mysqli->query($accountingQuery);
                                    while ($row = $accountingResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-warning">
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Medicine Table -->
                <div id="medicineTable" class="table-container" style="display:none;">
                    <div class="card bg-danger">
                        <div class="card-header bg-danger">
                            <h5 class="m-0">Medicine Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-danger text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $medicineQuery = "SELECT * FROM books WHERE category='Medicine' LIMIT 10";
                                    $medicineResult = $mysqli->query($medicineQuery);
                                    while ($row = $medicineResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-danger">
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Law Table -->
                <div id="LawTable" class="table-container" style="display:none;">
                    <div class="card bg-info">
                        <div class="card-header bg-info">
                            <h5 class="m-0">Law Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-info text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $lawQuery = "SELECT * FROM books WHERE category='Law' LIMIT 10";
                                    $lawResult = $mysqli->query($lawQuery);
                                    while ($row = $lawResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-info btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-info">
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Other Table -->
                <div id="OtherTable" class="table-container" style="display:none;">
                    <div class="card bg-secondary">
                        <div class="card-header bg-secondary">
                            <h5 class="m-0">Other Books</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-secondary text-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Edition</th>
                                        <th>Pages</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $otherQuery = "SELECT * FROM books WHERE category='Other' LIMIT 10";
                                    $otherResult = $mysqli->query($otherQuery);
                                    while ($row = $otherResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['edition']; ?></td>
                                            <td><?php echo $row['page']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><a href="edit_books.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary btn-rounded"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href="process/process_books.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-rounded Delete"><i class="fas fa-trash"></i>&nbsp;Delete</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-secondary">
                                        <td colspan="7"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.js"></script>
<script>
    // DataTable Initialization
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false
        });
    });

    // Function to Show Table based on Category
    function showTable(tableId) {
        $('#tables > div').hide();
        $('#' + tableId).show();
    }
</script>
</body>
</html>


<?php include('footer.php')?>