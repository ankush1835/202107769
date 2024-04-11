<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer - Homie Recipes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Customer</h2>
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

    if (isset($_GET['id'])) {
        $customerID = $_GET['id'];

        // Query to retrieve customer details by ID
        $sql = "SELECT * FROM Customers WHERE CustomerID = $customerID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="customerID" value="<?php echo $row['CustomerID']; ?>">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $row['FirstName']; ?>" required><br>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $row['LastName']; ?>" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required><br>
                <label for="profileImage">Profile Image:</label>
                <input type="file" id="profileImage" name="profileImage"><br>
                <input type="submit" value="Update" name="submit">
            </form>
            <?php
        } else {
            echo "Customer not found.";
        }
    }

    // Handle form submission
    if(isset($_POST['submit'])) {
        $customerID = $_POST["customerID"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];

        // Handle image upload if a new image is provided
        if ($_FILES["profileImage"]["name"]) {
            $targetDirectory = "uploads/";
            $targetFile = $targetDirectory . basename($_FILES["profileImage"]["name"]);
            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
                $profileImagePath = $targetFile;
                $sql = "UPDATE Customers SET FirstName='$firstName', LastName='$lastName', Email='$email', ProfileImage='$profileImagePath' WHERE CustomerID=$customerID";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $sql = "UPDATE Customers SET FirstName='$firstName', LastName='$lastName', Email='$email' WHERE CustomerID=$customerID";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
