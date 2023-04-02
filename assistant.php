<?php
// Set up the API endpoint and key
$endpoint = 'https://api.openai.com/v1/completions';
$api_key = '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';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the text prompt from the form
    $prompt = $_POST['prompt'];

    // Set up the parameters for the API request
    $data = array(
        'prompt' => $prompt,
        'temperature' => 0.7,
        'max_tokens' => 250,
        'n' => 1,
        'model' => 'text-davinci-002',
    );

    // Encode the data as JSON
    $data_json = json_encode($data);

    // Set up the HTTP headers
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$api_key,
    );

    // Set up the HTTP request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Send the HTTP request and get the response
    $response_json = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        $error = 'Error: '.curl_error($ch);
    } else {
        // Decode the response JSON
        $response = json_decode($response_json, true);

        // Extract the completed text
        $completed_text = $response['choices'][0]['text'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Set font styles */
body {
    font-family: Arial, sans-serif;
    font-size: 16px;
}

h1 {
    font-size: 32px;
    font-weight: bold;
    color: #666362;
    text-align: center;
}

h2 {
    font-size: 24px;
    font-weight: bold;
    color: #666362;
}

/* Center form and input elements */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

input[type="submit"] {
    margin-top: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0069d9;
}

/* Set border and padding for form elements */
textarea {
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 4px;
}

textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Set width of textarea */
textarea {
    width: 100%;
    max-width: 500px;
}

/* Set margin for completed text */
.completed-text {
    margin-top: 16px;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 4px;
    background-color: #fffff;
}
 /* Navigation */
        nav {
            background-color: #f2f2f2;
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-size: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #ddd;
            color: #333;
        }

     /* Main Content */
        main {
            padding: 20px;
        }

        
    </style>
     <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylehome.css">
    <title>V.A</title>
</head>
<body>
    <div class="topnav">
      <h1>Assistant 1.3</h1>
      
    </div>
     <nav>
        <a href="Assistant.php" onclick="sayHello()">Assistant</a>
        <a href="home.html" onclick="toggleLight()">Smart Home</a>
        <a href="" onclick="playVideo()">YouTube</a>
        <a href="logout.php">Logout</a>
    </nav>
    


    <h1>Virtual Assistant</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="prompt">Enter your query here:</label><br>
        <textarea name="prompt" rows="5" cols="50"></textarea><br>
        <input type="submit" value="Ask">
    </form>
    <?php if (isset($completed_text)): ?>
        <h2>Answer:</h2>
        <p><?php echo $completed_text; ?></p>
    <?php endif; ?>
    
</body>
</html>
