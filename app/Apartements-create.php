<?php 
header('Refresh:3;url=dashboard.php');
require_once('../config/Database.php');
require_once('../models/Apartment.php');
 
 
  $Owner_name = $_POST['Owner_name'] ;
  $Apartment_number= $_POST['Apartment_number'];
    

  $database = new Database();
  $db= $database->connect();

  $Apartment= new Apartment($db);
  
 
  
  $Apartmentstmt= $Apartment->create($Owner_name,$Apartment_number);
  
  if($Apartmentstmt){
      echo "created Sccussefully !";
  }else{
    echo "there is an error";
  }
   

?>

