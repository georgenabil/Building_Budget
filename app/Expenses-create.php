<?php

//header('Refresh:3;url=dashboard.php'); 
require_once('../config/Database.php');
require_once('../models/Treasury.php');
require_once('../models/Receivable.php');
require_once('../models/Apartment.php');
require_once('../models/Expense.php');


$database = new Database();
$db= $database->connect();



$Expense = new Expense($db);
$Treasury  = new Treasury($db);

$FlatAndOwner = explode("+",$_POST['Apartment_Id']); 
$dateTime = new DateTime($_POST['Date']);



$Expense->Made_by=$FlatAndOwner[1];       
$Expense->Amount=$_POST['Expenses'];      
$Expense->Description=$_POST['Description'];   
$Expense->Apartment_Id=$FlatAndOwner[0];  
$Expense->Date=$dateTime->getTimestamp();



$BalanceAmount =$Treasury->read()['Amount'];

if($BalanceAmount <= $Expense->Amount){
    echo"the Amount in The Teasury Can`t afford these Expenses";
}else{
 $NewAmount =$BalanceAmount-($Expense->Amount);
 $Treasury->update($NewAmount);
 $Expense->create();

 echo "Done Succssfully";

}

?>