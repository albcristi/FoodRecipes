<?php 
   $connection = new mysqli("localhost", "root", "","food_recipes");
   $id = $_GET['id'];
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        echo "Record not registered in the database";
        return;
   }
   $result = $connection->query("delete from recipes where id=$id");
   if($connection->query("select id from recipes where id=$id")->num_rows == 0){
        echo 'Record deleted';
        return;
   }
   echo "Delete Failed";
?>