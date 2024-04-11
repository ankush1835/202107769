<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server hostname if different
$username = "username"; // Change this to your database username
$password = "password"; // Change this to your database password
$dbname = "homie_recipes"; // Change this to your database name

// Check if customer ID is provided via GET parameter
if(isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to delete customer record with provided ID
    $sql = "DELETE FROM Customers WHERE CustomerID = $customerId";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
