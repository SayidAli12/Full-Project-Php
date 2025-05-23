<?php include('header1.php') ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Password</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Adding Bootstrap and Font Awesome for enhanced styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    margin-top: 50px;
}

h1 {
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
    background-color: #fff;
    color: #333;
    border: 1px solid #ccc;
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
       
        <form method="POST" action="process/process_update.php" onsubmit="return validate()">
            <div class="card mx-auto" style="width: 40%">
                <div class="card-body" style="box-shadow: 0 0 50px 0 lightgrey;">
                    <h3 class="card-header text-white">New Password</h3>
                    <div class="form-group">
                        <label class="text-white" for="new_pass">New Password</label>
                        <input type="password" name="new_pass" id="new_pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="confirm">Confirm Password</label>
                        <input type="password" name="confirm" id="confirm" class="form-control" required>
                    </div>
                    <button style="width: 100px;" class="btn btn-primary rounded-pull" name="Change_pass" type="submit">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>

<script >
	function validate(){
      var new_pass = $('#new_pass').val();
      var confirm_pass =$('#confirm').val();

      if (new_pass!=confirm_pass){
      	alert('Password did not  match');
      	return false;
      }else{
      	if (confirm('Are You Sure To Change Password')==true){
      	return true;
      }else{

      		return false;
      	}
      	}
      }
</script>
</div>
</div>
<?php include('footer.php') ?>