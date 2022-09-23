<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToLetters;



$frConvertor = new ConvertNumberToLetters('fr');

// exemple 1: 2000
echo $frConvertor->convertNumberToLetters(2000);

// exemple 2: 2050
echo $frConvertor->convertNumberToLetters(2050);