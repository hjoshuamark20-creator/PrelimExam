<?php
session_start();

// Example credentials for demonstration.
// In production, retrieve the hashed password from a database.
$storedUsername = "admin";
$storedPasswordHash = password_hash("password123", PASSWORD_DEFAULT);

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if (
        hash_equals($storedUsername, $username) &&
        password_verify($password, $storedPasswordHash)
    ) {
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;

        header("Location: dashboard.php");
        exit;
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #444;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            background: #ffe5e5;
            color: #c00;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 18px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if ($error): ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                required
                autocomplete="username"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
