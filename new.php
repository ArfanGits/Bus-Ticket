<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bus_ticket";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
	die("connection failed");
}

$username = $_POST['username'];
$email = $_POST['email'];
$phone_no = $_POST['phone_no'];
$no_of_people = $_POST['no_of_people'];
$country = $_POST['country'];
$date = $_POST['date'];
$from = $_POST['from'];
$to = $_POST['to'];

$sql = "INSERT INTO booking (username,email,phone_no,no_of_people,country,date,from,to)
VALUES ('$username', '$email', '$phone_no', '$no_of_people', '$country', '$date', '$from', '$to')";

if ($conn->query($sql) === TRUE) {
?>
	<script>
		alert('Bus Ticket Reserverd Sucessfully');
	</script>
<?php
} else {
?>
	<script>
		alert('Booking Failed!!!');
	</script>
<?php
}


?>