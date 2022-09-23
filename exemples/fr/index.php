<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToFrLetters;



$frConvertor = new ConvertNumberToFrLetters();

// exemple 1: 2000
echo $frConvertor->convertNumberToFrLetters(2000);

// exemple 2: 2050
echo $frConvertor->convertNumberToFrLetters(2050);