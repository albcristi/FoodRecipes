<?php 
   $connection = new mysqli("localhost", "root", "","food_recipes");
   $id = $_GET['id'];
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        $connection->close();
        echo "Record not registered in the database";
        return;
   }
   $result = $connection->query("delete from recipes where id=$id");
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        $connection->close();
        echo 'Record deleted';
        return;
   }
   $connection->close();
   echo "Delete Failed";
?>