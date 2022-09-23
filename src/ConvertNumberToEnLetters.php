<?php
namespace RosaireKota\Convertor;
use RosaireKota\Convertor\contracts\ConvertNumberToLetterInterface;

class  ConvertNumberToEnLetters implements  ConvertNumberToLetterInterface{

    public function convertNumberToEnLetters($value): string
    {   $result ="";
        $numberConvertedToString = (string)($value);
        $strLength = strlen(trim($numberConvertedToString));

        if($strLength >0 && $strLength <4)
        {
            $result = $this->convertBelowThousand($numberConvertedToString);
        }else if($strLength >= 4 && $strLength < 7)
        {
            $result = $this->convertThousandLetter($numberConvertedToString);
        }else if($strLength >=7 && $strLength < 10)
        {
            $result = $this->convertToMillionLetter($numberConvertedToString);

        }else if($strLength >=9 && $strLength <= 12)
        {
            $result = $this->convertBillionLetter($numberConvertedToString);

        }else
        {
            $result = "0";
        }

        return ucwords($result);
    }

    /**
     * @param $number
     * @return string
     */
    public function convertBelowThousand($number): string
    {
        $units = ['','one','two','three','four','five','six','seven','eight','nine','dix','ten','eleven','Twelve','thirteen','fourteen','fifteen','seventeen','eighteen','nineteen'];

        $tens = ['','ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'];

        $unit = $number%10;
        $ten = ($number%100 - $unit)/10;
        $hund = ($number%1000 -($number%100))/100;

        $unitOut = '';
        $tenOut = '';
        $hundOut = '';

        if($number === 0)
        {
            return 'zero';
        }else
        {
            $unitOut = ($unit === 1 && $ten>0 && $ten !== 8 ? 'and-' : '')."".$units[$unit];

            if($ten === 1 && $unit > 0)
            {
                $tenOut = $units[10 + $unit];
                $unitOut = '';
            }
            else if($ten === 7 || $ten === 9)
            {
                $tenOut = $tens[$ten] ."".'-'."". ($ten === 7 && $unit === 1 ? 'and-' : '' ) ."". $units[10 + $unit];
                $unitOut = '';
            }else
            {
                $tenOut = $tens[$ten];
            }
            $tenOut .= ($unit === 0 && $ten === 8 ? 's' : '');

            $hundOut = ($hund > 1 ? $units[$hund]."".'-':'')."".($hund > 0 ?'One hundred':'')."".(($hund>1 && $ten == 0 && $unit == 0)? 's' : '');

            return $hundOut ."". ($hundOut && $tenOut ? '-' : '') ."". $tenOut ."". ($hundOut && $unitOut || $tenOut && $unitOut ? '-' : '') ."". $unitOut;
        }
    }

    /**
     * @param $str
     * @return string
     */
    public function convertThousandLetter(string $str): string
    {
        $thounsandLength = strlen($str);
        $end = substr($str, -3);
        $start = substr($str, 0,$thounsandLength-3);

        $strResultStart = "";
        $strResultEnd = "";

        if((int)($start) === 1)
        {
            $strResultStart = " thousand ";
        }else if((int)($start) === 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($start))." thousands ";
        }
        if((int)($end) !== 0)
        {
            $strResultEnd = $this->convertBelowThousand((int)($end));
        }
        return 	$strResultStart." ".$strResultEnd;
    }

    /**
     * @param $str
     * @return string
     */
    public function convertToMillionLetter(string $str):string
    {
        $millionLength = strlen($str);
        $end = substr($str, -3);
        $middle =  substr($str, -6, 3);
        $strStart = substr($str, 0,$millionLength-6);

        $strResultStart = "";
        $strResultEnd = "";

        if((int)($strStart)==1)
        {
            $strResultStart = $this->convertBelowThousand((int)($strStart))." million ";
        }else if((int)($strStart) == 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($strStart))." millions ";
        }

        if((int)($end)==0 && (int)($middle)==0)
        {
            $strResultEnd = "";
        }else
        {
            $strResultEnd = $this->convertThousandLetter($middle." ".$end);
        }
        return $strResultStart." ".$strResultEnd;
    }

    /**
     * @param $str
     * @return string
     */
    public function convertBillionLetter(string $str):string
    {
        $billionLength = strlen($str);
        $end = substr($str, -3);
        $middle =  substr($str, -6, 3);
        $strStart =  substr($str, -9, 3);
        $strBegin = substr($str, 0, $billionLength - 9);

        $strResultStart = "";
        $strResultEnd = "";

        if((int)$strBegin === 1)
        {
            $strResultStart = $this->convertBelowThousand((int)($strBegin))." billion ";
        }else if((int)($strBegin) == 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($strBegin))." billions ";
        }

        if((int)($end)==0 && (int)($middle)==0 && (int)($strStart)==0)
        {
            $strResultEnd = "";
        }else
        {
            $strResultEnd = $this->convertToMillionLetter($strStart."".$middle."".$end);
        }
        return $strResultStart." ".$strResultEnd;
    }
}