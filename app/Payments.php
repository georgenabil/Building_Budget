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
$Treasury = new Treasury($db);
$Receivable= new Receivable($db);

$Treasuryrow = $Treasury->read();
$Apartmentstmt = $Apartment->read();
$Receivablestmt = $Receivable->readWithDistinctApartments(); 


?>
<div class="container">
      <div class="form-warper"> 


         <form id="Paymentform" action="Payment-create.php" method="post">
         <h2> Payments </h2>
         <div class="form-input">
              <label>Apartment number</label>
              <select name="Apartment_Id" id="Apartment_Id">
                <?php while($Receivablesrow = $Receivablestmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?=$Receivablesrow['Apartment_id'] ?>"> <?=$Receivablesrow['Apartment_number'] ?></option>
                <?php } ?>
              </select>
         </div>
         
         <div class="form-radio"> 
             <label> Type </label>                   
             <div class="raido-options"> 
                   <input type="radio" id="monthly" name="PaymentType" value="monthly" required  >
                      <label for="monthly">monthly</label>
                   <input type="radio" id="emergency" name="PaymentType" value="emergency">
                      <label for="emergency">emergency</label>
                   <input type="radio" id="ALL" name="PaymentType" value="ALL">
                      <label for="ALL">ALL</label>
                </div>    
         </div>

         
         <div class="form-button">
               <button type="submit" class="btn btn-info">Payed</button>
          </div>      
         </form>
       </div>
</div>


