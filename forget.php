<?php include('header1.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burao Library - Contact Form</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Adding Bootstrap for enhanced styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style >
	body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0;
}

.container {
    margin-top: 50px;
}

h1 {
	font-family: sans-serif;
    font-size: 36px;
    animation: fadeInDown 1s ease-in-out;
}

.card {
    background-image: url(D.png);
    animation: fadeInUp 1s ease-in-out;
}

.form-control {
    position: relative;
    z-index: 1;
    background-color: fff;
    color: #333;
    border: 1px solid #fff;
    border-radius: 5px;
    padding: 10px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007BFF;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
<body>
    <div class="container">
        <center>
            <h1>Uob Library</h1>
        </center>
        <br>
        <form method="POST" action="process/process_forget.php">
            <?php if (isset($_SESSION['username'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['username'];
                unset($_SESSION['username']);
                ?>
            </div>
            <?php endif ?>    
            <div class="card mx-auto" style="width: 40%">
                <div class="card-body" style="box-shadow: 0 0 50px 0 lightskyblue;">
                    <h3 class="card-header text-white">Checking</h3>
                    <div class="form-group">
                        <label class="text-white" for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required autocomplete="off">
                    </div>
                    <button style="width: 100px;" class="btn btn-primary rounded-pull" name="Update_Pass" type="submit">
                     Checking
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php include('footer.php') ?>