<?php   
       $connection = new mysqli("localhost", "root", "","food_recipes");
       $id = $_GET['id'];
       $description = $_GET['description'];
       $steps = $_GET['steps'];
       if($connection->query("select id from recipes where id=$id")->num_rows == 0){
            $connection->close();
            echo "Mmm...We couldn't find this recipe. Try again!";
            return;
       }
       $connection->query("update recipes set description='$description', steps='$steps' where id=$id");
       $connection->close();
       echo "Thanks for your contribution. Together we will make the best of our recipes!";
?>