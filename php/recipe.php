<?php

class Recipe implements JsonSerializable{
    private $id;
    private $name;
    private $chefLname;
    private $chefFname;
    private $description;
    private $steps;
    private $type;
    
    public function __construct($id, $name, $chefLname, $chefFname, $steps, $type, $description){
        $this->id = $id;
        $this->name = $name;
        $this->chefLname = $chefLname;
        $this->chefFname = $chefFname;
        $this->steps = $steps;
        $this->type = $type;
        $this->description = $description;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getChefLname(){
        return $this->chefLname;
    }
    
    public function getChefFname(){
        return $this->chefFname;
    }
    
    public function getSteps(){
        return $this->steps;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function jsonSerialize(){
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>