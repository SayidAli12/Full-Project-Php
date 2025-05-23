<?php include('login_header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Login Form</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    body {
      background-color: #080710;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #ffffff;
      font-family: 'Poppins', sans-serif;
    }
    .background {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }
    .background .shape {
      height: 200px;
      width: 200px;
      position: absolute;
      border-radius: 50%;
    }
    .shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: 450px;
    top: 20px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: 450px;
    bottom: 20px;
}
    form {
      background-color: rgba(255, 255, 255, 0.13);
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
      padding: 50px 35px;
      width: 400px;
    }
    form * {
      letter-spacing: 0.5px;
      outline: none;
      border: none;
    }
    form h3 {
      font-size: 32px;
      font-weight: 500;
      line-height: 42px;
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 30px;
      font-size: 16px;
      font-weight: 500;
    }
    input {
      display: block;
      height: 50px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
      color: #e5e5e5;
    }
    ::placeholder {
      color: #e5e5e5;
    }
    button {
      margin-top: 50px;
      width: 100%;
      background-color: #ffffff;
      color: #080710;
      padding: 15px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
    }
    .social {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }
    .social div {
      width: 100%;
      border-radius: 3px;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.27);
      color: #eaf0fb;
      text-align: center;
    }
    .social div:hover {
      background-color: rgba(255, 255, 255, 0.47);
    }
  </style>
</head>
<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <form method="POST" action="process/process_login.php">
    <h3>Uob Library</h3>
    <h3>Login </h3>
    <?php if (isset($_SESSION['empty'])): ?>
      <div class="alert alert-danger text-center">
        <?php echo $_SESSION['empty']; unset($_SESSION['empty']); ?>
      </div>
    <?php endif ?>

    <?php if (isset($_SESSION['incorrect_login'])): ?>
      <div class="alert alert-danger text-center">
        <?php echo $_SESSION['incorrect_login']; unset($_SESSION['incorrect_login']); ?>
      </div>
    <?php endif ?>
    
    <label for="username"><i class="fas fa-user"></i> Username</label>
    <input type="text" name="username" placeholder="Username" id="username" autocomplete="off" required>
    
    <label for="password"><i class="fas fa-lock"></i> Password</label>
    <input type="password" name="password" placeholder="Password" id="password" autocomplete="off" required>
    
    <button name="login" type="submit">Login</button>
    
    <div class="social">
      <div><a href="forget.php" style="color: #eaf0fb; text-decoration: none;"><i class="fas fa-key"></i> Forget Password</a></div>
    </div>
  </form>
</body>
</html>
