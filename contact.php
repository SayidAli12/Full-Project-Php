<?php include ('header.php') ?>

<?php
include('Conection.php');

if ($mysqli->connect_error) {
die('not connected');
}
else {
	
	echo "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            background-image: url('D.png');
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            color: #fff;
        }

        input, textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .contact-info {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>
        <form method="POST" action="process/process_contact.php" onsubmit="return validateForm()">
            <label for="your_name">Name</label>
            <input type="text" id="your_name" name="your_name" required pattern="[A-Za-z\s]+" title="Name should contain letters and spaces only.">

            <label for="your_email">Email</label>
            <input type="email" id="your_email" name="your_email" required>

            <label for="your_message">Message</label>
            <textarea id="your_message" name="your_message" rows="6" required></textarea>

            <button type="submit" name="send">Send Message</button>
        </form>
    </div>
    <script>
        function validateForm() {
            let name = document.getElementById('your_name').value;
            let namePattern = /^[A-Za-z\s]+$/;

            if (!namePattern.test(name)) {
                alert('Name should contain letters and spaces only.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
