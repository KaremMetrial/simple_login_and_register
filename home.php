<?php 
session_start();
include("php/config.php");
if(!isset($_SESSION["valid"])) {
    header("location:index.php");
    exit(); // Add exit to stop further script execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <?php
            // Sanitize the ID
            $id = $_SESSION['id'];
            $user = $conn->prepare('SELECT * FROM users WHERE id=:id');
            $user->bindValue(':id', $id);
            $user->execute();
            // Check if the query was successful
            if ($user && $user->rowCount() > 0) {
                $result = $user->fetch(PDO::FETCH_ASSOC);
                $res_user = htmlspecialchars($result['username']);
                $res_email = htmlspecialchars($result['email']);
                $res_age = htmlspecialchars($result['age']);
                $res_id = htmlspecialchars($result['id']);
            }
            ?>
            <a href="logout.php">
                <button class="btn"><a href="php/logout.php">logout</a></button>
            </a>
        </div>
    </div>
    <main class="main">
    <div class="main-box top">
        <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_user; ?></b></p>
            </div>
            <div class="box">
                <p>Your email is : <b><?php echo $res_email; ?></b></p>
            </div>
        </div>
        <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $res_age; ?> years old</b></p>
            </div>
        </div>
    </div>
</main>
</body>

</html>