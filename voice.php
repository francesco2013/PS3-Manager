<?php
 // Setup Web Service
 $objSoap = new SoapClient("https://tts.neospeech.com/soap_1_1.php?wsdl");
 // Invoke Call to ConvertSimple
 $strResultArray = $objSoap->ConvertSimple(
 "ffazio1@gmail.com",
 "4a8bfc4c6e",
 "LoginKey",
 "dae589c25cb576461aef",
 "TTS_PAUL_DB",
 "FORMAT_WAV",
 16,
 "The quick brown fox jumps over the lazy dog.");
 // Iterate through the returned string array
 foreach(explode(",", $strResultArray[0]) as $intIndex => $strValue)
 print $strResultArray[$intIndex+1] . " = " . $strValue . "<br/>";
?>
Example “ConvertSimple” Code – Raw SOAP Request