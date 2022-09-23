<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToLetters;



$enConvertor = new ConvertNumberToLetters('en');

// exemple 1: 2000
echo $enConvertor->convertNumberToLetters(2000);

// exemple 2: 2050
echo $enConvertor->convertNumberToLetters(2050);