<?php include('header.php') ?>

<?php
include('Conection.php');
$id = $_GET['edit'];
$result = $mysqli->query("SELECT br.*, s.student_name, s.address , s.contact, s.Faculty, b.book_name , b.edition , b.category , b.qty from borrows br   
		inner join books b on br.book_id = b.id   
		inner join students  s on br.Student_id = s.id

		where br.id = '$id'




	");
$row = $result->fetch_array();
?>

	        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: ;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-image: url('D.png');
            width: 30%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
        }

        .card-title {
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        label {
            margin-top: 1rem;
            color: #fff;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-radius: 5px;
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .btn
 {
            margin-top: 1rem;
            width: 120px;
            background: #007bff;
            border: 2px solid #007bff;
            color: #fff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            background: #0056b3;
            border-color: #0056b3;
        }

        .btn i {
            margin-right: 5px;
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
                <h4 class="card-title">Update Form</h4>
            </center>
            <form method="POST" action="process/process_borrows.php">
                <input readonly type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <div class="mb-3">
                    <label>Date Off</label>
<input type="text" name="time" required  class="form-control" autocomplete="off" required value="<?php echo $row ['time'] ?> " >  
<label>Date On</label>
<input type="text" name="date" required  class="form-control" autocomplete="off"  required value="<?php echo $row ['date'] ?> "> 
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status" required>
                        <option value=""><?php echo $row['status'] ?></option>
                        <option value="returned">Returned</option>
                        
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary rounded-pill" name="update" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Update
                    </button>
                    <a class="btn btn-primary rounded-pill" href="view_borrows.php">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include('footer.php')?>

