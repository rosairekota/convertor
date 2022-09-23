<?php
namespace RosaireKota\Convertor;

use RosaireKota\Convertor\Providers\ConvertNumberToEnLetters;
use RosaireKota\Convertor\Providers\ConvertNumberToFrLetters;
use RosaireKota\Convertor\Providers\ConvertNumberToChiLetters;

class ConvertNumberToLetters {
    
    /**
     * @var ConvertorConvertNumberToFrLetters
     */
    public $convertor;

    /**
     * @var string
     */
    public $language;

    public function __construct(?string $language = 'fr')
    {
       $this->language = strtolower($language);
    }

    public function convertNumberToLetters($value): ?string{
        if ($this->language==='en') {
            $this->convertor = ConvertNumberToEnLetters::getInstance();
            return $this->convertor->convertNumberToEnLetters($value);
        }
        if ($this->language==='chi') {
            $this->convertor = ConvertNumberToChiLetters::getInstance();
            return $this->convertor->convertNumberToChiLetters($value);
        }
       
        $this->convertor = ConvertNumberToFrLetters::getInstance();
        return $this->convertor->convertNumberToFrLetters($value);
        
    }
    
}