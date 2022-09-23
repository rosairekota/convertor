<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToEnLetters;



$frConvertor = new ConvertNumberToEnLetters();

// exemple 1: 2000
echo $frConvertor->convertNumberToEnLetters(2000);

// exemple 2: 2050
echo $frConvertor->convertNumberToEnLetters(2050);