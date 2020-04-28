<?php 
      require_once '../php/recipe.php';
      $userType = (isset($_GET['type_rec'])) ? $_GET['type_rec'] : 0;
      if($userType == 0){
        echo "";
        return;
      }
      
      $connection = new mysqli("localhost", "root", "","food_recipes");
      $rows = $connection->query("SELECT r.id, r.name, c.fname, c.lname, r.description, r.steps, r.type FROM recipes r inner join chefs c on c.id=r.chefId where r.type=$userType");
          $response = array();
          while($row = $rows->fetch_assoc())
          {  
              $result = new Recipe( $row['id'],
                                     $row['name'],
                                     $row['fname'],
                                     $row['lname'],
                                     $row['steps'],
                                     $row['type']);
              array_push($response, $result);
          }
          $connection->close();
          echo json_encode($response);
?>