<?php 
      require_once '../php/recipe.php';
      $userType =  $_GET["type_rec"]; 
      $connection = new mysqli("localhost", "root", "","food_recipes");
      $sqlSelect = "SELECT r.id, r.name, c.fname, c.lname, r.description, r.steps, r.type FROM recipes r inner join chefs c on c.id=r.chefId where r.type = '$userType'";
      $rows = $connection->query($sqlSelect);  
      $response = array();
      while($row = $rows->fetch_assoc())
      {  
          $result = new Recipe( $row['id'],
                                 $row['name'],
                                 $row['fname'],
                                 $row['lname'],
                                 $row['steps'],
                                 $row['type'],
                                 $row['description']);
          array_push($response, $result);
      }
      $connection->close();
      echo json_encode($response);
?>