<?php
namespace RosaireKota\Convertor\Providers;
use RosaireKota\Convertor\contracts\ConvertNumberToLetterInterface;

class  ConvertNumberToChiLetters implements  ConvertNumberToLetterInterface{


    protected static $instance = null;

    public static function getInstance (){
        if (self::$instance === null) {
            self::$instance = new ConvertNumberToChiLetters();
        }
        return self::$instance;
    }
    
    public function convertNumberToChiLetters($value): string
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
        $units = ['','yī','èr','sān','sì','wǔ','liù','qī','bā','jiǔ','shí','shí yī','shí èr','shí sān','shí sì','shí wǔ','shí liù','shí qī','shí bā','shí jiǔ'];

        $tens = ['','shí','èr shí','sān shí','sì shí','wǔ shí','liù shí','qī shí','bā shí','jiǔ shí'];

        $unit = $number%10;
        $ten = ($number%100 - $unit)/10;
        $hund = ($number%1000 -($number%100))/100;

        $unitOut = '';
        $tenOut = '';
        $hundOut = '';

        if($number === 0)
        {
            return 'líng';
        }else
        {
            $unitOut = ($unit === 1 && $ten>0 && $ten !== 8 ? 'et-' : '')."".$units[$unit];

            if($ten === 1 && $unit > 0)
            {
                $tenOut = $units[10 + $unit];
                $unitOut = '';
            }
            else if($ten === 7 || $ten === 9)
            {
                $tenOut = $tens[$ten] ."".'-'."". ($ten === 7 && $unit === 1 ? '和-' : '' ) ."". $units[10 + $unit];
                $unitOut = '';
            }else
            {
                $tenOut = $tens[$ten];
            }
            $tenOut .= ($unit === 0 && $ten === 8 ? 's' : '');

            $hundOut = ($hund > 1 ? $units[$hund]."".'-':'')."".($hund > 0 ?'yì bǎi':'')."".(($hund>1 && $ten == 0 && $unit == 0)? 's' : '');

            return $hundOut ."". ($hundOut && $tenOut ? '-' : '') ."". $tenOut ."". ($hundOut && $unitOut || $tenOut && $unitOut ? '-' : '') ."". $unitOut;
        }
    }

    /**
     * @param $str
     * @return string
     */
    public function convertThousandLetter($str): string
    {
        $thounsandLength = strlen($str);
        $end = substr($str, -3);
        $start = substr($str, 0,$thounsandLength-3);

        $strResultStart = "";
        $strResultEnd = "";

        if((int)($start) === 1)
        {
            $strResultStart = " yì qiān ";
        }else if((int)($start) === 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($start))." yì qiān ";
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
    public function convertToMillionLetter($str):string
    {
        $millionLength = strlen($str);
        $end = substr($str, -3);
        $middle =  substr($str, -6, 3);
        $strStart = substr($str, 0,$millionLength-6);

        $strResultStart = "";
        $strResultEnd = "";

        if((int)($strStart)==1)
        {
            $strResultStart = $this->convertBelowThousand((int)($strStart))." yìbǎi wàn ";
        }else if((int)($strStart) == 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($strStart))." yìbǎi wàn ";
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
    public function convertBillionLetter($str):?string
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
            $strResultStart = $this->convertBelowThousand((int)($strBegin))." shí yì ";
        }else if((int)($strBegin) == 0)
        {
            $strResultStart = "";
        }else
        {
            $strResultStart = $this->convertBelowThousand((int)($strBegin))." shí yì ";
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