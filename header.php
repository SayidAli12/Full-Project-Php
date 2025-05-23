<?php 
session_start();
if (!isset($_SESSION['username'])) {
header('location:login.php');
}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uob Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    


    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #ffc107;
            --text-color: #fff;
            --hover-bg-color: #000;
            --hover-text-color: #ffc107;
            --active-link-bg-color: #ffc107;
            --active-link-color: #000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
        }

        .main {
            width: 100%;
            background-image: url(D.png);
            height: 12vh;
            display: flex;
            align-items: center;
            animation: slideDown 1s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon {
            display: flex;
            align-items: center;
        }

        .logo {
            color: var(--text-color);
            font-size: 35px;
            font-family: Georgia;
            padding-left: 10px;
        }

        .menu {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
        }

        .menu ul {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
        }

        .menu ul li {
            margin-left: 30px;
            font-size: 15px;
            position: relative;
            transition: all 0.3s ease;
        }

        .menu ul li a {
            text-decoration: none;
            color: var(--text-color);
            font-family: Arial, sans-serif;
            position: relative;
            padding-bottom: 5px;
        }

        .menu ul li a:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #000;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out 0s;
        }

        .menu ul li a:hover:before {
            visibility: visible;
            transform: scaleX(1);
        }

        .menu ul li:hover {
            color: var(--hover-text-color);
            animation: pulse 0.5s infinite alternate;
        }

        .menu ul li .active-link {
            background-color: var(--active-link-bg-color);
            color: var(--active-link-color);
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn {
            width: 100px;
            height: 40px;
            background: var(--primary-color);
            border: 2px solid var(--hover-bg-color);
            color: var(--text-color);
            font-size: 15px;
            border-radius: 5px;
            transition: 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background: var(--hover-bg-color);
            border-color: var(--hover-bg-color);
            color: var(--hover-text-color);
        }

        .btn:focus {
            outline: none;
        }

        .content {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            color: #000;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.1);
            }
        }
        /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
    </style>
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">UOB Library</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php" id="home-link"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="view_student.php" id="students-link"><i class="fas fa-user-graduate"></i> Students</a></li>
                    <li><a href="view_books.php" id="books-link"><i class="fas fa-book"></i> Books</a></li>
                    <li><a href="view_borrows.php" id="borrows-link"><i class="fas fa-book-reader"></i> Borrows</a></li>
                    <li><a href="available.php" id="reports-link"><i class="fas fa-file-alt"></i> Reports</a></li>
                    <?php if ($_SESSION['role'] == 'Admin') : ?>
                    <li><a href="view_user.php" id="users-link"><i class="fas fa-users"></i> Users</a></li>
                    <li><a href="view_feedback.php" id="feedback-link"><i class="fas fa-envelope"></i> Feedback</a></li>
                    <?php endif ?>   
                    <?php if ($_SESSION['role'] == 'User') : ?>
                    <li><a href="contact.php" id="contact-link"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    <li><a href="Change_password.php" id="change-password-link"><i class="fas fa-key"></i> Ch.Password</a></li>
                    <?php endif ?>
                    <li><a href="process/process_logout.php" id="logout-link"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
     

    <script>
        // Highlight the active link based on the current URL
        const currentURL = window.location.href;
        document.querySelectorAll('.menu ul li a').forEach(link => {
            if (link.href === currentURL) {
                link.classList.add('active-link');
            }
        });
    </script>
   

</body>
</html>


  <?php include('footer.php')?>