<?php
function getInstallmentAmounts($amount, $num_installments){ 
        /*** check if the payments are exact ***/ 
        if($amount % $num_installments == 0){ 
            /*** if payments are exact, just some simple math ***/ 
            $installment_amount = $amount/$num_installments; 
            $final_installment = $installment_amount; 
        } else { 
            /*** get the installment percentage of amount ***/ 
            $percent = ceil(100/$num_installments)+1; 

            /*** calculate the installment amounts ***/ 
            $installment_amount = floor($amount*$percent/100); 

            /*** initialize the final payment amount ***/ 
            $final_installment = $amount; 

            /*** calculate the last payment ***/ 
            while($final_installment > $installment_amount) { 
                $final_installment -= $installment_amount; 
            }
        } 
return array('installment_amount'=>$installment_amount, 'final_installment'=>$final_installment); 
}


$amount = 1270; /*** amount to pay ***/ 
$make_installments = 4; /*** amount of installments ***/ 
$info = getInstallmentAmounts($amount, $make_installments);
echo $amount.' in '.$make_installments.' Installments,  Installment Amount: '.$info['installment_amount'].'. Final Installment: '.$info['final_installment'];


echo "<hr>";


function getNumOfInstallment($amount, $installments){ 
        /*** initialize number of payments required ***/ 
        $num_installments = 1; 
        /*** initialize the amount of the last payment ***/ 
        $last_payment = $amount; 
        /*** calculate the number of payments and the amount of the last payment ***/ 
        while($last_payment > $installments){ 
            /*** subtract from last payment ***/ 
            $last_payment -= $installments; 
            $num_installments++; 
        } 
/*** return array has number of payments plus the amount of the final payment ***/ 
return array('num_installments'=>$num_installments, 'last_payment'=>$last_payment); 
} 

$amount = 1234.31; /*** amount to pay ***/ 
$installments = 500; /*** amount of installments ***/ 
$info = getNumOfInstallment($amount, $installments); 
echo $amount." in ".$info['num_installments'].' installments('.$installments.'). Last installment is '.$info['last_payment']; 