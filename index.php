<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include "php/config.php";

            if (isset($_POST['submit'])) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $result = $conn->prepare('SELECT * FROM users WHERE email = :email');
                $result->bindValue(':email', $email);
                $result->execute();

                $user = $result->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['age'] = $user['age'];
                        $_SESSION['id'] = $user['id'];

                        header("Location: home.php");
                        exit();
                    } else {
                        echo "<div class='message'>
                            <p>Incorrect email or password</p>
                        </div> <br>";
                    }
                } else {
                    echo "<div class='message'>
                        <p>Incorrect email or password</p>
                    </div> <br>";
                }
            }
            ?>
            <header>Login</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <input class="btn" type="submit" name="submit" value="Login">
                </div>
                <div class="link">
                    Don't have an account? <a href="register.php">Sign up now</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>