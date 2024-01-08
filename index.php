 <?php
session_start();

// Sample user data (replace with your actual user data from a database)
$validUser = array(
    'email' => 'user@example.com',
    'password' => password_hash('password123', PASSWORD_DEFAULT),
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Login logic
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email === $validUser['email'] && password_verify($password, $validUser['password'])) {
            // Set a session variable to indicate a logged-in user
            $_SESSION['user'] = $validUser['email'];

            // Redirect to the homepage
            header('Location: /homepage.php');
            exit;
        } else {
            $loginError = 'Invalid email or password';
        }
    }

    // Registration logic
    if (isset($_POST['register'])) {
        // Perform registration logic here (you'll add this later with a real database)
        $registrationSuccess = 'Registration successful!';

        // Redirect to the homepage
        header('Location: /homepage.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>Login</h2>
        <?php if (isset($loginError)) : ?>
            <p class="error"><?php echo $loginError; ?></p>
        <?php endif; ?>
        <label for="loginEmail">Email:</label>
        <input type="email" name="email" id="loginEmail" placeholder="Enter your email" required>

        <label for="loginPassword">Password:</label>
        <input type="password" name="password" id="loginPassword" placeholder="Enter your password" required>

        <button type="submit" name="login">Login</button>

        <hr>

        <h2>Registration</h2>
        <?php if (isset($registrationSuccess)) : ?>
            <p class="success"><?php echo $registrationSuccess; ?></p>
        <?php endif; ?>
        <label for="registerEmail">Email:</label>
        <input type="email" name="email" id="registerEmail" placeholder="Enter your email" required>

        <label for="registerPassword">Password:</label>
        <input type="password" name="password" id="registerPassword" placeholder="Enter your password" required>

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
