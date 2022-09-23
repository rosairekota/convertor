<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToChiLetters;



$frConvertor = new ConvertNumberToChiLetters();

// exemple 1: 2000
echo $frConvertor->convertNumberToChiLetters(2000);

// exemple 2: 2050
echo $frConvertor->convertNumberToChiLetters(2050);