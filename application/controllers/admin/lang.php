<?php
  define('ROOT1', $_SERVER['DOCUMENT_ROOT']);
  function GetLang($key,$i)
    {
        $value ="";
        switch($i)
        {
            case "en-US":
                $xml = simplexml_load_file(ROOT1."/resource/en-US.xml");       
                $value = (string) $xml->$key;         
                break;
            case "in-IN":
                $xml = simplexml_load_file(ROOT1."/resource/in-IN.xml");       
                $value = (string) $xml->$key;         
                break;
        }
        return $value; 
    }
?>
