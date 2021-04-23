<?php
$ApiKeyTest = "4Vj8eK4rloUd272L48hsrarnUA";
$merchant_id = $_REQUEST['merchant_id'];
$reference_sale = $_REQUEST['reference_sale'];
$value = $_REQUEST['value'];
if(preg_match("/^[0-9]+([.][0-9][0])?$/",$value)){
	$valueFormated = number_format($value, 1, '.', '');
}else{
	$valueFormated = $value;
}
$currency = $_REQUEST['currency'];
$state_pol = $_REQUEST['state_pol'];
$firma_cadena_test = "$ApiKeyTest~$merchant_id~$reference_sale~$valueFormated~$currency~$state_pol";
$signatureTest = md5($firma_cadena_test);
$firmaPost = $_REQUEST['sign'];
if (strtoupper($firmaPost) == strtoupper($signatureTest)) { 
	$file = fopen("ConfirmationPageLogs.txt", "a");
    fwrite($file, "\r\n");
	fwrite($file, "===============SANDBOX TRANSACTION===============" . "\r\n");
	fwrite($file, ">>>>>>>>>>>>>>>SIGNATURE MATCHES<<<<<<<<<<<<<<<" . "\r\n");
    fwrite($file, "===============HEADERS===============" . "\r\n");
    foreach (getallheaders() as $nombre => $valor) {
        fwrite($file, $nombre . ": " . $valor . "\r\n");
    }
    fwrite($file, "===============BODY===============" . "\r\n");
    foreach ($_POST as $key => $value) {
        fwrite($file, $key . ": " . $value . "\r\n");
    }
	fwrite($file, "\r\n");
    fclose($file);
	
}else{
	$file = fopen("ConfirmationPageLogs.txt", "a");
    fwrite($file, "\r\n");
    fwrite($file, "\r\n");
	fwrite($file, ">>>>>>>>>>>>>>>SIGNATURE DO NOT MATCH<<<<<<<<<<<<<<<" . "\r\n");
	fwrite($file, "SandboxString: $firma_cadena_test - SandboxSign: $signatureTest - signaturePost: $firmaPost" . "\r\n");
    fwrite($file, "===============HEADERS===============" . "\r\n");
    foreach (getallheaders() as $nombre => $valor) {
        fwrite($file, $nombre . ": " . $valor . "\r\n");
    }
    fwrite($file, "===============BODY===============" . "\r\n");
    foreach ($_POST as $key => $value) {
        fwrite($file, $key . ": " . $value . "\r\n");
    }
	fwrite($file, "\r\n");
    fclose($file);
}
?>