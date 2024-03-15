<?php

function formatCurrency($amount)
{
    if(request()->cookie('currency')){
        $symbol = request()->cookie('currency');
    }else{
        $symbol = "AED";
    }
    
    $decimalSeparator = '.';
    $thousandsSeparator = ',';

    $formattedAmount = $symbol . number_format((float)$amount, 2, $decimalSeparator, $thousandsSeparator);

    return $formattedAmount;
}
