<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uob Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        /* CSS Variables for easy color management */
        :root {
            --primary-color: #007bff;
            --secondary-color: #ffc107;
            --text-color: #fff;
            --hover-bg-color: #000;
            --hover-text-color: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .main {
            width: 100%;
            background-image: url(D.png);
            height: 12vh;
            display: flex;
            align-items: center;
            animation: slideDown 1s ease-in-out;
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
            height: 70px;
        }

        .logo {
            color: var(--text-color);
            font-size: 35px;
            font-family: Arial, sans-serif;
            padding-left: 20px;
            display: flex;
            align-items: center;
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
            font-weight: bold;
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
            background-color: var(--hover-bg-color);
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
        }

        /* Keyframes for animations */
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
    </style>
</head>

<body>
    <div class="main">
        <div class="navbar">
    </div>
  </div>
</body>

  <?php include('footer.php')?>