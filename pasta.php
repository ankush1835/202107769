<?php
// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "homie_recipes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM recipes WHERE name = 'Homemade Pasta'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $description = $row["description"];
        $ingredients = $row["ingredients"];
        $instructions = $row["instructions"];
    }
} else {
    echo "No recipe found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pasta</title>
    <link rel="stylesheet" href="cake.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="main">
            <div class="logo">
                <img src="https://i.postimg.cc/WbJLFc67/logo.png">
            </div>
            <ul>
                <li class="active"><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="salad.php">Salad</a></li>
                <li><a href="burger.php">Burger</a></li>
                <div class="sub-menu">
                    <ul>
                        <li><a href="#">Sandwich</a></li>
                        <li><a href="#">Shake</a></li>
                    </ul>
                </div>
            </ul>
        </div>
        <div class="title"></div>
        <div class="button">
            <a href="#" class="btn">Scroll down for video</a>
        </div>
    </header>
    <iframe src="https://www.youtube.com/embed/mMOaRiVd-3o" frameborder="0" allowfullscreen></iframe>
    <h2><?php echo $name; ?></h2>
    <p><?php echo $description; ?></p>
    <h3>Ingredients:</h3>
    <p><?php echo nl2br($ingredients); ?></p>
    <h3>Instructions:</h3>
    <p><?php echo nl2br($instructions); ?></p>
</body>
</html>
