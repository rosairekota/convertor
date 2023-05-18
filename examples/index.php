<?php

require __DIR__.'/../vendor/autoload.php';

use RosaireKota\Convertor\ConvertNumberToLetters;



$frConvertor = new ConvertNumberToLetters(); // the default language is fr

//e.g.1: 2000
echo $frConvertor->convertNumberToLetters(2000);

//e.g.2 2050
echo $frConvertor->convertNumberToLetters(2050);

// Deux Milles  Cinquante