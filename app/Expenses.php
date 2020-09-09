<?php
require_once('navbar.php');

require_once('../config/Database.php');
require_once('../models/Treasury.php');
require_once('../models/Receivable.php');
require_once('../models/Apartment.php');
//require_once('../models/Expense.php');

$database = new Database();
$db= $database->connect();

$Apartment = new Apartment($db);
$Apartmentstmt = $Apartment->read();
 


?>
 
 <div class="container">
      <div class="form-warper">  

<form id="Expensesform" action="Expenses-create.php" method="post">
     <h2> Expenses </h2>
    <div class="form-input">
       <label>Expenses</label>
       <input id="Expenses" type="number" class="form-control" name="Expenses" required min="0"  step="0.01" >
   
    </div>
    <div class="form-input">
       <label>Description</label>
       <input id="Description" type="text" class="form-control" name="Description" required >
   
    </div>
   
    <div class="form-input">
         <label>Owner name</label>
         <select name="Apartment_Id" id="Apartment_Id">
           <?php while($Apartmentrow = $Apartmentstmt->fetch(PDO::FETCH_ASSOC)) { ?>
           <option value="<?= $Apartmentrow['Id']."+".$Apartmentrow['Owner_name'] ?>"><?=$Apartmentrow['Owner_name'] ?></option>
           <?php } ?>   
         </select>
    </div>
    <div class="form-input">
       <label>date</label>
       <input id="Date" type="date" class="form-control" name="Date" required >
            
    </div>
   
   <div class="form-button">
      <button type="submit" class="btn btn-info">Sumbit</button>
   </div>
   
</form>
</div>
</div>




 

