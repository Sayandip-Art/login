<?php
    session_start();
    include('dbconnect.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM login WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p>Username password combination is wrong!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['username'] = $result['username'];
                echo '<p>Congratulations, you are logged in!</p>';
                header("location: welcome.php");
            } else {
                echo '<p>Username password combination is wrong!</p>';
            }
        }
    }
?>