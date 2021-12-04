<?php
/*session_start();*/
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password =md5($_POST["password"]);
    $checkSqlsign = "SELECT * FROM signup_system WHERE Phone_No='$phone' AND Email_Id='$email'";
    $searchsign = mysqli_query($conn, $checkSqlsign);
    if (!$searchsign->num_rows > 0) {
        $sqlsign = "INSERT INTO `signup_system` (`Username`, `Phone_No`, `Email_Id`, `Password`, `Date_of_Signup`) VALUES ('$username', '$phone', '$email', '$password', current_timestamp());";
        $sqllog = "INSERT INTO `login`(`username`, `password`) VALUES ('$username','$password')";
        $resultsign = mysqli_query($conn, $sqlsign);
        $resultlog=mysqli_query($conn,$sqllog);
        if ($resultsign){
            echo  "<p>Wow! Your account is now created,please login...</p>";
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['username'] = $uname;
            $_SESSION['password'] = $pword;
            header("location: index2.php");
            $uname = "";
			$email = "";
            $phone = "";
			$_POST['pword'] = "";
        }
        else{
            $_SESSION['showAlert'] = "Woops! Your account is not created...";
        }
    }
    else{
        $_SESSION['showAlert'] = "Woops! You have already exists,please login...";
    }  
}
?>