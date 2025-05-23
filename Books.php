<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Books</title>
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
                <h4 class="card-title">Add Books</h4>
            </center>
            <form id="bookForm" method="POST" action="process/process_books.php" onsubmit="return validateForm()">
                <label for="book_name">Book Name</label>
                <input type="text" id="book_name" name="book_name" required class="form-control" autocomplete="off" pattern="[A-Za-z\s]+" title="Book name should contain letters and spaces only.">
                
                <label for="edition">Edition</label>
                <input type="text" id="edition" name="edition" required class="form-control" autocomplete="off"  pattern="\d+" title="Edition should contain numbers only.">
               
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Social Science">Social Science</option>
                    <option value="Technology">Technology</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Medicine">Medicine</option>
                    <option value="Law">Law</option>
                    <option value="Other">Other</option>
                </select>
                
                <label for="page">Number Of Pages</label>
                <input type="text" id="page" name="page" required class="form-control" autocomplete="off" pattern="\d+" title="Number of pages should contain numbers only.">
                
                <label for="qty">Quantity</label>
                <input type="text" id="qty" name="qty" required class="form-control" autocomplete="off" pattern="\d+" title="Quantity should contain numbers only.">
                
                <div class="d-flex justify-content-between mt-3">
                    <button style="width:100px;" class="btn btn-primary rounded-pill" name="save" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
                    <a class="btn btn-primary rounded-pill" href="view_books.php">
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
            let bookName = document.getElementById('book_name').value;
            let edition = document.getElementById('edition').value;
            let category = document.getElementById('category').value;
            let pages = document.getElementById('page').value;
            let quantity = document.getElementById('qty').value;

            let namePattern = /^[A-Za-z\s]+$/;
            let alphanumericPattern =  /^\d+$/;
            let numberPattern = /^\d+$/;

            if (!namePattern.test(bookName)) {
                alert('Book name should contain letters and spaces only.');
                return false;
            }

            if (!alphanumericPattern.test(edition)) {
                alert('Edition should contain  numbers only.');
                return false;
            }

            if (!namePattern.test(category)) {
                alert('Category should contain letters and spaces only.');
                return false;
            }

            if (!numberPattern.test(pages)) {
                alert('Number of pages should contain numbers only.');
                return false;
            }

            if (!numberPattern.test(quantity)) {
                alert('Quantity should contain numbers only.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>

<?php include('footer.php')?>

