<?php   
       $connection = new mysqli("localhost", "root", "","food_recipes");
       $id = $_GET['id'];
       $description = $_GET['description'];
       $steps = $_GET['steps'];
       if($connection->query("select id from recipes where id=$id")->num_rows == 0){
            echo "Record not registered in the database";
            return;
       }
       $connection->query("update recipes set description='$description', steps='$steps' where id=$id");
       echo "Record has been updated";
?>