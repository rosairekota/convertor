# convertor
This library help you to convert numbers to letters.

### Languages availables:
- French (default)
- English
- Chinesse

### Installation:
- composer require rosairekota/convertor

### Example

use RosaireKota\Convertor\ConvertNumberToLetters;


$frConvertor = new ConvertNumberToLetters("en"); // the default language is fr

// exemple 1: 2000
echo $frConvertor->convertNumberToLetters(2000);