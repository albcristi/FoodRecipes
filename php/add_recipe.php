<?php
     require_once '../php/recipe.php';
     $connection = new mysqli("localhost", "root", "","food_recipes");
     $result = $connection->query("select max(id) as mid from recipes");
     $id = $result->fetch_assoc()['mid'] + 1;
     $description = $_GET['description'];
     $steps = $_GET['steps'];
     $name = $_GET['name'];
     $type = $_GET['type'];
     $connection->query("insert into recipes (id, chefId, name, description, steps, type) values ($id, 5, '$name', '$description', '$steps', '$type')");
     $connection->close();
     echo "Thanks for your contribution! Your recipe has the ID $id";
?>