<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .recipe-list {
            margin-top: 20px;
        }
        .nav-menu {
            background-color: #333;
            overflow: hidden;
        }
        .nav-menu a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .nav-menu a:hover {
            background-color: #ddd;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="nav-menu">
    <li><a href="pasta.php">Pasta</a></li>
                <li><a href="salad.php">Salad</a></li>
                <li><a href="burger.php">Burger</a></li>
                <li><a href="Signin.php">Sign Up</a></li>
                <li><a href="Retrieve.php">Users</a></li>
                <li><a href="manage.php">Recipes</a></li>
    </div>
    <div class="container">
        <h2>Recipe Management</h2>
        <form action="" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" required></textarea><br>
            <label for="ingredients">Ingredients:</label><br>
            <textarea id="ingredients" name="ingredients" rows="4" required></textarea><br>
            <label for="instructions">Instructions:</label><br>
            <textarea id="instructions" name="instructions" rows="4" required></textarea><br>
            <input type="submit" value="Add Recipe">
        </form>

        <div class="recipe-list">
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

            // Function to display all recipes
            function displayRecipes($conn) {
                $sql = "SELECT * FROM recipes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>All Recipes</h2>";
                    while($row = $result->fetch_assoc()) {
                        echo "<div>";
                        echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                        echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
                        echo "<p><strong>Ingredients:</strong><br>" . nl2br($row["ingredients"]) . "</p>";
                        echo "<p><strong>Instructions:</strong><br>" . nl2br($row["instructions"]) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "No recipes found";
                }
            }

            // If form is submitted, add new recipe
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["name"];
                $description = $_POST["description"];
                $ingredients = $_POST["ingredients"];
                $instructions = $_POST["instructions"];

                $sql = "INSERT INTO recipes (name, description, ingredients, instructions) VALUES ('$name', '$description', '$ingredients', '$instructions')";

                if ($conn->query($sql) === TRUE) {
                    echo "New recipe created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Display all recipes
            displayRecipes($conn);

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
