<?php

namespace RosaireKota\Convertor\contracts;

interface ConvertNumberToLetterInterface
{

    /**
     * @param $number
     * @return string
     */
    public function convertBelowThousand(?string $number): ?string;


    /**
     * @param $str
     * @return string
     */
    public function convertThousandLetter(string $str): ?string;


    /**
     * @param $str
     * @return string
     */
    public function convertToMillionLetter(string $str):?string;


    /**
     * @param $str
     * @return string
     */
    public function convertBillionLetter(string $str):?string;

}