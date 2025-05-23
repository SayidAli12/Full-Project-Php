<?php include('header.php') ?>
<?php 
include('Conection.php');
$new_result = $mysqli->query("
      SELECT id, book_name, edition from books
    ") or die(mysqli_error($mysqli));
$result = $mysqli->query("
      SELECT id, student_name,address, contact,Faculty from students
    ") or die(mysqli_error($mysqli));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            background-image: url('D.png');
            width: 100%;
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        label {
            margin-top: 1rem;
            color: #fff;
            font-weight: bold;
        }

        .form-control {
            margin: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .btn {
            margin-top: 1rem;
            width: 100px;
            background: #007bff;
            border: 2px solid #007bff;
            color: #fff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn:hover {
            background: #0056b3;
            border-color: #0056b3;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 10px;
        }

        .card-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
        }
    </style>
</head>

<body>
    <div class="card card-center mx-auto">
        <div class="card-body">
            <center>
                <h4 class="card-title">Add Borrows</h4>
            </center>
            <form method="POST" action="process/process_borrows.php">
                <div class="form-group">
                    <label for="Student_id">Student</label><br>
                    <select id="Student_id" name="Student_id" class="form-control custom-select" required>
                        <option value="">Select</option>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['id'].' - '.$row['student_name'].' - '.$row['contact'].' - '.$row['address'].' - '.$row['Faculty'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="book_id">Book</label><br>
                    <select id="book_id" name="book_id" class="form-control custom-select" required>
                        <option value="">Select</option>
                        <?php while($row = $new_result->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']?>"><?php echo $row['id'].' - '.$row['book_name'].' - '.$row['edition'] ?></option>
                        <?php endwhile; ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="time">Date Out</label>
                    <input type="date" id="time" name="time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date">Return Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary rounded-pill" name="save" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
                    <a class="btn btn-primary rounded-pill" href="view_borrows.php">
                        <i class="fa-solid fa-delete-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <!-- Include Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Initialize Select2 on document ready
        $(document).ready(function() {
            $('#Student_id').select2({
                placeholder: 'Select a student',
                allowClear: true // Option to allow clearing selected value
            });

            $('#book_id').select2({
                placeholder: 'Select a book',
                allowClear: true // Option to allow clearing selected value
            });
        });
    </script>
</body>

</html>
