<?php
$servername = "localhost";
$username = "root"; // replace with your username
$password = ""; // replace with your password
$dbname = "manuscripts_catalog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_GET['search'];

$sql = "SELECT * FROM manuscripts_catalog WHERE tajuk LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Title: " . $row["Tajuk"]. "<br>";
        // You can display other fields here
    }
} else {
    echo "0 results";
}
$conn->close();
?>
