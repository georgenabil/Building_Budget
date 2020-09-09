<?php

require_once('../config/Database.php');
require_once('../models/Treasury.php');
require_once('../models/Receivable.php');
require_once('../models/Apartment.php');
require_once('../models/Expense.php');


$database = new Database();
$db= $database->connect();

$Apartment  = new Apartment($db);
$Receivable = new Receivable($db);
$Treasury  = new Treasury($db);

$Apartment_Id = $_POST['Apartment_Id']; // 3 
$Type=$_POST['PaymentType']; //  monthly || emergency || ALL

    $sum = 0;

    $Receivable->Apartment_Id=$Apartment_Id;
    $Receivable->Type=$Type;
    $Receivablestmt=$Receivable->findAll();

    while($Receivablerow = $Receivablestmt->fetch(PDO::FETCH_ASSOC)) {
          $sum+=$Receivablerow['Charges'];
          $Receivable->delete($Receivablerow['Id']);
    }
     
    $Amount=$Treasury->read()['Amount'];
    $NewAmount = $sum+$Amount;
    
    $Treasury->update($NewAmount);


 if($Receivablestmt){
     echo "done successfully ";
 }

?>