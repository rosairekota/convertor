<?php

require __DIR__.'/../../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToLetters;



$chinesseConvertor = new ConvertNumberToLetters('chi');

// exemple 1: 2000
echo $chinesseConvertor->convertNumberToLetters(2000);

// exemple 2: 2050
echo $chinesseConvertor->convertNumberToLetters(2050);