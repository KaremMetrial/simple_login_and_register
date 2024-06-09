<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
    <?php
            include "php/config.php";
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $verify_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $verify_email->bindParam(":email", $email);
                $verify_email->execute();

                if ($verify_email->rowCount() > 0) {
                    echo "<div class='message'>
                            <p>this email is used , try another one please!</p>
                        </div> </br>";
                    echo "<a href='javascript:self.history.back()'> <button class='btn' >Go Back</button> </a>";
                } else {
                    $verify_email = $conn->prepare("INSERT INTO users (username, email, age, password) VALUES (:username, :email, :age, :password)");
                    $verify_email->bindParam(":username", $username);
                    $verify_email->bindParam(":email", $email);
                    $verify_email->bindParam(":age", $age);
                    $verify_email->bindParam(":password", $pass);
                    $verify_email->execute();

                    echo '<div class="message">
                    <p>Registration Successfuly</p>
                     </div> </br>';
                    echo "<a href='index.php'> <button class='btn' >Login now</button> </a>";
                }
            } else {
            ?>
        <div class="box form-box">
            <header>Register</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <input class="btn" type="submit" name="submit" value="sign up" required>
                </div>
                <div class="link">
                    Do you have account? <a href="index.php">sign in</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>