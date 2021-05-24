<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($username) || !empty($email) || !empty($password)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bus_ticket";


    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_error() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From signup Where email = ? Limit 1";
        $INSERT = "INSERT Into signup (username,email,password) values(?,?,?)";


        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            header("location: ../login.html");
        } else {
            echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All field are required";
    die();
}
