<?php
// Open session var
session_start();
// views: 1 = first visit; >1 = second visit

// Detect language from user agent browser
function lixlpixel_get_env_var($Var)
{
     if(empty($GLOBALS[$Var]))
     {
         $GLOBALS[$Var]=(!empty($GLOBALS['_SERVER'][$Var]))?
         $GLOBALS['_SERVER'][$Var] : (!empty($GLOBALS['HTTP_SERVER_VARS'][$Var])) ? $GLOBALS['HTTP_SERVER_VARS'][$Var]:'';
     }
}

function lixlpixel_detect_lang()
{
     // Detect HTTP_ACCEPT_LANGUAGE & HTTP_USER_AGENT.
     lixlpixel_get_env_var('HTTP_ACCEPT_LANGUAGE');
     lixlpixel_get_env_var('HTTP_USER_AGENT');

     $_AL=strtolower($GLOBALS['HTTP_ACCEPT_LANGUAGE']);
     $_UA=strtolower($GLOBALS['HTTP_USER_AGENT']);

     // Try to detect Primary language if several languages are accepted.
     foreach($GLOBALS['_LANG'] as $K)
     {
         if(strpos($_AL, $K)===0)
         return $K;
     }

     // Try to detect any language if not yet detected.
     foreach($GLOBALS['_LANG'] as $K)
     {
         if(strpos($_AL, $K)!==false)
         return $K;
     }
     foreach($GLOBALS['_LANG'] as $K)
     {
         //if(preg_match("/[[( ]{$K}[;,_-)]/",$_UA)) // matching other letters (create an error for seo spyder)
         return $K;
     }

     // Return default language if language is not yet detected.
     return $GLOBALS['_DLANG'];
}

// Define default language.
$GLOBALS['_DLANG']='en';

// Define all available languages.
// WARNING: uncomment all available languages

$GLOBALS['_LANG'] = array(
'af', // afrikaans.
'ar', // arabic.
'bg', // bulgarian.
'ca', // catalan.
'cs', // czech.
'da', // danish.
'de', // german.
'el', // greek.
'en', // english.
'es', // spanish.
'et', // estonian.
'fi', // finnish.
'fr', // french.
'gl', // galician.
'he', // hebrew.
'hi', // hindi.
'hr', // croatian.
'hu', // hungarian.
'id', // indonesian.
'it', // italian.
'ja', // japanese.
'ko', // korean.
'ka', // georgian.
'lt', // lithuanian.
'lv', // latvian.
'ms', // malay.
'nl', // dutch.
'no', // norwegian.
'pl', // polish.
'pt', // portuguese.
'ro', // romanian.
'ru', // russian.
'sk', // slovak.
'sl', // slovenian.
'sq', // albanian.
'sr', // serbian.
'sv', // swedish.
'th', // thai.
'tr', // turkish.
'uk', // ukrainian.
'zh' // chinese.
);

// Redirect to the correct location.
// Example Implementation aff var lang to name file
/*
echo 'The Language detected is: '.lixlpixel_detect_lang(); // For Demonstration
echo "<br />";    
*/
$lang_var = lixlpixel_detect_lang(); //insert lang var system in a new var for conditional statement
/*
echo "<br />";    

echo $lang_var; // print var for trace

echo "<br />";    
*/
// Insert the right page iacoording with the language in the browser
switch ($lang_var){
    case "fr":
        //echo "PAGE DE";
        include("index_fr.php");//include check session DE
        break;
    case "it":
        //echo "PAGE IT";
        include("index_it.php");
        break;
    case "en":
        //echo "PAGE EN";
        include("index_en.php");
        break;        
    default:
        //echo "PAGE EN - Setting Default";
        include("index_en.php");//include EN in all other cases of different lang detection
        break;
}
?>