<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            background-image: url('D.png');
            width: 30%;
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
                <h4 class="card-title">Add Students</h4>
            </center>
            
            <form id="studentForm" method="POST" action="process/process_students.php" onsubmit="return validateForm()">
                <label for="student_name">Name</label>
                <input type="text" id="student_name" name="student_name" required class="form-control" autocomplete="off" pattern="[A-Za-z\s]+" title="Name should contain letters and spaces only.">
                
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                
                <label for="Address">Address</label>
                <input type="text" id="Address" name="Address" required class="form-control" autocomplete="off" pattern="[A-Za-z0-9\s]+" title="Address should contain letters, numbers, and spaces only.">
                
                <label for="Contact">Contact</label>
                <input type="text" id="Contact" name="Contact" required class="form-control" autocomplete="off" pattern="\d+" title="Contact should contain numbers only.">
                
                <label for="Faculty">Faculty</label>
                <select id="Faculty" name="Faculty" class="form-control" required>
                    <option value="">Select</option>
                    <option value="ICT">ICT</option>
                    <option value="Business Administration">Business Administration</option>
                    <option value="Social Science">Social Science</option>
                    <option value="Accounting">Accounting</option>
                    <option value="HRM">HRM</option>
                    <option value="Medicine">Medicine</option>
                </select>
                
                <label for="semester">Semester</label>
                <input type="text" id="semester" name="semester" required class="form-control" autocomplete="off" pattern="[A-Za-z\s]+" title="Name should contain letters and spaces only.">
                
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary rounded-pill" name="save" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
                    <a class="btn btn-primary rounded-pill" href="view_student.php">
                        <i class="fa-solid fa-delete-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            let name = document.getElementById('student_name').value;
            let contact = document.getElementById('Contact').value;
            let address = document.getElementById('Address').value;
            let semester = document.getElementById('semester').value;

            let namePattern = /^[A-Za-z\s]+$/;
            let numberPattern = /^\d+$/;
            let addressPattern = /^[A-Za-z0-9\s]+$/;


            if (!namePattern.test(name)) {
                alert('Name should contain letters and spaces only.');
                return false;
            }

            if (!numberPattern.test(contact)) {
                alert('Contact should contain numbers only.');
                return false;
            }

            if (!addressPattern.test(address)) {
                alert('Address should contain letters, numbers, and spaces only.');
                return false;
            }

            if (!namePattern.test(semester)) {
                alert('Semester should contain letters and spaces only.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>

<?php include('footer.php')?>

