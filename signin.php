<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_ticket";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("connection failed");
}

$username = $_POST["username"];
$password = $_POST["password"];


$sql = mysqli_query($conn, "SELECT count(*) as total from signup WHERE username = '" . $username . "' and 
	password = '" . $password . "'");

$row = mysqli_fetch_array($sql);

if ($row["total"] > 0) {

	header("location: ../booking.html");

	/*?>
	<script>
		
		alert('Login successful');


	</script>
	
	<?php */
} else {
?>
	<script>
		alert('Login failed');
	</script>
<?php
}

?>