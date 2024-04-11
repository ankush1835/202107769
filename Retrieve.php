<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homie Recipes - Customer List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .edit-btn, .delete-btn {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .edit-btn:hover, .delete-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Customer List</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Profile Image</th>
            <th>Actions</th>
        </tr>
        <?php
        // Database connection parameters
        $servername = "localhost"; // Change this to your database server hostname if different
        $username = "username"; // Change this to your database username
        $password = "password"; // Change this to your database password
        $dbname = "homie_recipes"; // Change this to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve all customer records
        $sql = "SELECT * FROM Customers";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CustomerID"]. "</td>";
                echo "<td>" . $row["FirstName"]. " " . $row["LastName"]. "</td>";
                echo "<td>" . $row["Email"]. "</td>";
                echo "<td><img src='" . $row["ProfileImage"] . "' alt='Profile Image' style='width:100px;height:100px;'></td>";
                echo "<td><a class='edit-btn' href='edit_customer.php?id=" . $row["CustomerID"] . "'>Edit</a>";
                echo "<a class='delete-btn' href='delete_customer.php?id=" . $row["CustomerID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 results</td></tr>";
        }

        // Close database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
