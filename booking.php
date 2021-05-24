<?php

$username = $_POST['username'];
$email = $_POST['email'];
$phone_no = $_POST['phone_no'];
$no_of_people = $_POST['no_of_people'];
$country = $_POST['country'];
$b_date = $_POST['b_date'];
$b_from = $_POST['b_from'];
$b_to = $_POST['b_to'];

if (
    !empty($username) || !empty($email) || !empty($phone_no)
    || !empty($no_of_people) || !empty($country) || !empty($b_date) || !empty($b_from) || !empty($b_to)
) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bus_ticket";


    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_error() . ')' . mysqli_connect_error());
    } else {

        $SELECT = "SELECT email From booking Where email = ? Limit 1";
        $INSERT = "INSERT Into booking (username,email,phone_no,no_of_people,country,b_date,b_from,b_to) values(?,?,?,?,?,?,?,?)";


        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssss", $username, $email, $phone_no, $no_of_people, $country, $b_date, $b_from, $b_to);
            $stmt->execute();
            header("location: ../close.html");
            /*?>
            <script>
                alert('Bus Ticket Reserverd Sucessfully');
            </script>
        <?php*/
        } else {
?>
            <script>
                alert('Someone already used this email');
            </script>
    <?php
        }
        $stmt->close();
        $conn->close();
    }
} else {
    ?>
    <script>
        alert('All field are required');
    </script>
<?php
    die();
}
