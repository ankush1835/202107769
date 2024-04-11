<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homie Recipes</title>
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
                <li><a href="pasta.php">Pasta</a></li>
                <li><a href="salad.php">Salad</a></li>
                <li><a href="burger.php">Burger</a></li>
                <li><a href="Signin.php">Sign Up</a></li>
                <li><a href="Retrieve.php">Users</a></li>
                <li><a href="manage.php">Recipes</a></li>
                <div class="sub-menu">
                    <ul>
                        <li><a href="#">Sandwich</a></li>
                        <li><a href="#">Shake</a></li>
                    </ul>
                </div>
            </ul>
        </div>
        <div class="title">
            <h1>Homie Recipes</h1>
        </div>
        <div class="button">
            <a href="#" class="btn">Watch Videos</a>
        </div>
    </header>
    <div class="recipes-container">
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

        // Function to retrieve recipes from the database
        function getRecipes($conn) {
            $sql = "SELECT * FROM recipes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='recipe'>";
                    echo "<h2>" . $row["name"] . "</h2>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p><strong>Ingredients:</strong> " . $row["ingredients"] . "</p>";
                    echo "<p><strong>Instructions:</strong> " . $row["instructions"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No recipes found";
            }
        }

        // Display recipes
        getRecipes($conn);

        $conn->close();
        ?>
    </div>
</body>
</html>
