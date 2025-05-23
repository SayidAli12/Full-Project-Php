<?php include ('header.php') ?>
<?php
include('Conection.php');
// Query to get count of students
$student_result = $mysqli->query("SELECT COUNT(*) AS student_count FROM students");
$student_count = $student_result->fetch_assoc()['student_count'];

$books_result = $mysqli->query("SELECT COUNT(*) AS books_count FROM books");
$books_count = $books_result->fetch_assoc()['books_count'];

$borrows_result = $mysqli->query("SELECT COUNT(*) AS borrows_count FROM borrows");
$borrows_count = $borrows_result->fetch_assoc()['borrows_count'];

$contact_result = $mysqli->query("SELECT COUNT(*) AS contact_count FROM contact");
$contact_count = $contact_result->fetch_assoc()['contact_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    /* Custom styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa; /* Light grey background */
      color: #343a40; /* Dark grey text */
      overflow-x: hidden; /* Prevent horizontal overflow */
    }
    .jumbotron {
      background-color: #0d6efd;
      color: #ffffff;
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      margin-bottom: 30px; /* Added margin for separation */
    }
    .jumbotron h1 {
      font-weight: bold;
      font-size: 2.5rem;
      margin-bottom: 20px; /* Added margin for separation */
    }
    .jumbotron hr {
      background-color: #fff; /* Changed HR color */
      margin: 20px auto; /* Center HR */
      max-width: 100px; /* Limit HR width */
      height: 2px; /* Adjust HR height */
    }
    .card {
      background-color: #f0f0f0; /* Updated: Light grey background for cards */
      border-radius: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      position: relative;
      border: 1px solid #ced4da; /* Added: Border style */
    }
    .card.bg-light {
      background-color: #f8f9fa; /* Updated: Light grey background */
    }
    .card::before,
    .card::after {
      content: '';
      position: absolute;
      background: rgba(0, 123, 255, 0.15);
      border-radius: 50%;
      z-index: 0;
    }
    .card::before {
      top: -20px;
      left: -20px;
      width: 80px;
      height: 80px;
    }
    .card::after {
      bottom: -20px;
      right: -20px;
      width: 60px;
      height: 60px;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
    .card-title {
      color: #007bff; /* Updated: Primary blue for titles */
      font-weight: bold;
      z-index: 1;
      position: relative;
    }
    .card-text {
      color: #6c757d; /* Updated: Dark grey text for card content */
      z-index: 1;
      position: relative;
    }
    .btn {
      border-radius: 8px;
      transition: background-color 0.3s ease, transform 0.3s ease;
      z-index: 1;
      position: relative;
      color: #ffffff; /* Text color for buttons */
      background-color: #007bff; /* Primary blue background for buttons */
      border: 1px solid #007bff; /* Border color */
    }
    .btn:hover {
      background-color: #0056b3; /* Darker blue on hover */
      transform: scale(1.05);
    }
    .icon-large {
      font-size: 3rem;
      margin-bottom: 15px;
      color: #007bff; /* Primary blue for icons */
      z-index: 1;
      position: relative;
      animation: bounce 2s infinite;
    }
    .footer {
      background-color: #007bff; /* Bootstrap primary blue */
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
    /* Keyframes for animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
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
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-15px);
      }
      60% {
        transform: translateY(-10px);
      }
    }
    @keyframes cardHover {
      0% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-5px);
      }
      100% {
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="jumbotron">
    <h1>Welcome To Library</h1>
    <hr class="my-4">
    <div class="row">
      <div class="col-md-4">
        <!-- Clock Widget -->
        <img src="logo-1.png" frameborder="0" width="250" height="250">
      </div>
      <div class="col-md-4">
        <!-- Student Section -->
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-user-graduate icon-large"></i>
            <h4 class="card-title">Students</h4>
            <p class="card-text">View and manage students</p>
            <a class="btn btn-primary mb-2" href="view_student.php">
              <i class="fas fa-eye"></i> View
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <!-- Books Section -->
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-book icon-large"></i>
            <h4 class="card-title">Books</h4>
            <p class="card-text">View and manage books</p>
            <a class="btn btn-primary mb-2" href="view_books.php">
              <i class="fas fa-eye"></i> View
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Management Section -->
    <div class="row">
      <div class="col-md-4">
        <!-- Borrows Section -->
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-book-reader icon-large"></i>
            <h4 class="card-title">Borrows</h4>
            <p class="card-text">View and manage borrows</p>
            <a class="btn btn-primary mb-2" href="view_borrows.php">
              <i class="fas fa-eye"></i> View
            </a>
          </div>
        </div>
      </div>
      <!-- Conditional Feedback Section -->
      <?php if ($_SESSION['role'] == 'Admin'): ?>
      <div class="col-md-4">
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-comment-dots icon-large"></i>
            <h4 class="card-title">Feedback</h4>
            <p class="card-text">View feedback in the system</p>
            <a class="btn btn-primary mb-2" href="view_feedback.php">
              <i class="fas fa-file-alt"></i> View
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-4">
        <!-- Reports Section -->
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-chart-line icon-large"></i>
            <h4 class="card-title">Reports</h4>
            <p class="card-text">Generate and view reports</p>
            <a class="btn btn-primary mb-2" href="available.php">
              <i class="fas fa-file-alt"></i> View
            </a>
          </div>
        </div>
      </div>
      <!-- Conditional Contact Us Section -->
      <?php if ($_SESSION['role'] == 'User'): ?>
      <div class="col-md-4">
        <div class="card bg-light">
          <div class="card-body text-center">
            <i class="fas fa-envelope icon-large"></i>
            <h4 class="card-title">Contact Us</h4>
            <p class="card-text">Contact us for any inquiries</p>
            <a class="btn btn-primary mb-2" href="contact.php">
              <i class="fas fa-file-alt"></i> Contact
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  // Initialize tooltips
  $(function () {
    $('[data-bs-toggle="tooltip"]').tooltip()
  })
</script>
</body>
</html>


<?php include('footer.php')?>