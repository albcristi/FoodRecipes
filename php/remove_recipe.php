<?php 
   $connection = new mysqli("localhost", "root", "","food_recipes");
   $id = $_GET['id'];
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        $connection->close();
        echo "Make sure the id describes a recipe";
        return;
   }
   $result = $connection->query("delete from recipes where id=$id");
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        $connection->close();
        echo 'Recipe remove';
        return;
   }
   $connection->close();
   echo "There's been a problem, try again later";
?>