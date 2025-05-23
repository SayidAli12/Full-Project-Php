<?php include('header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/datetimepicker/jquery.datetimepicker.css">

    <style>
        body {
            background-image: url('#');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            font-family: 'Helvetica Neue', sans-serif;
            color: #fff;
        }

        .container {
            margin-top: 100px;
        }

        h1 {
            color: #000;
            animation: fadeInDown 1s;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s;
            padding: 30px;
            background-image: url('D.png');
        }

        .card-title {
            color: #fff;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 30px;
            padding: 0.75rem 1.5rem;
            padding-left: 45px;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(81, 203, 238, 1);
            border-color: rgba(81, 203, 238, 1);
        }

        .form-control-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .password-toggle:hover,
        .form-control-icon:hover {
            color: #0056b3;
        }

        .alert {
            animation: shake 0.5s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>    
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <center>
                    <h4 class="card-title">Change Password</h4>
                </center>

                <?php if (isset($_SESSION['empty'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['empty']; unset($_SESSION['empty']); ?>
                    </div>
                <?php endif ?>
                

                <form method="POST" action="process/process_change.php" onsubmit="return validate()">
                    <?php if (isset($_SESSION['incorrect Old Passwod'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['incorrect Old Passwod']; unset($_SESSION['incorrect Old Passwod']); ?>
                        </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="old_pass" id="old_pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_pass" id="new_pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm</label>
                        <input type="password" name="confirm" id="confirm" class="form-control" required>
                    </div>
                  <div class="d-flex justify-content-between mt-3">
                    <button class=" btn-primary rounded-pull" name="Change_pass" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i> Change
                    </button>
                    <a class=" btn-primary rounded-pull" href="index.php">
                        <i class="fa-solid fa-delete-left"></i>Back
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="assets/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script >
	function validate(){
      var new_pass = $('#new_pass').val();
      var confirm_pass =$('#confirm').val();

      if (new_pass!=confirm_pass){
      	alert('Password did not  match');
      	return false;
      }else{
      	if (confirm('are you sure to Change Password')==true){
      	return true;
      }else{

      		return false;
      	}
      	}
      }
</script>
</body></html>
<?php include('footer.php') ?>