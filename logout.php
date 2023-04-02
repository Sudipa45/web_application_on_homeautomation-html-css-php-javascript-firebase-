<?php
// Check if the user clicked "Yes" to logout
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['confirm_logout'] == 'yes') {
    // Perform the logout action here
    // ...

    // Redirect the user to the homepage after logout
    header('Location: login.html');
    exit;
}

// If the user clicked "No" or accessed the page directly, show the confirmation page
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            background-color: #4285f4;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body>
    <div class="topnav">
      <h1> </h1>
      
    </div>
    <h1>Are you sure you want to logout?</h1>
    <form method="POST">
        <button type="submit" name="confirm_logout" value="yes">Yes</button>
        <button type="submit" name="confirm_logout" value="no">No</button>
    </form>
    <script>
        // Add event listener to "No" button to go back to previous page
        document.querySelector('button[value="no"]').addEventListener('click', function(event) {
            event.preventDefault();
            window.history.back();
        });
    </script>
</body>
</html>
