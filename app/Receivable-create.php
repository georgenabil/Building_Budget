<?php

header('Refresh:3;url=dashboard.php'); 
require_once('../config/Database.php');
require_once('../models/Treasury.php');
require_once('../models/Receivable.php');
require_once('../models/Apartment.php');
require_once('../models/Expense.php');


$database = new Database();
$db= $database->connect();

$Receivable = new Receivable($db);



$Receivable->Charges = $_POST['Charges'];
$Receivable->Description=$_POST['Description'];
$Receivable->Apartment_Id=$_POST['Apartment_Id'];
$Receivable->Type=$_POST['Type'];
$Receivable->Date=time();
 

if($_POST['Apartment_Id']=="ALL"){
  $Apartment  = new Apartment($db);
  $ApartmentStmt = $Apartment->read();
  $Receivablestmt = $Receivable->createMany($ApartmentStmt);
}else{
   $Receivablestmt = $Receivable->create();
}



 if($Receivablestmt){
     echo "done successfully ";
 }

?>