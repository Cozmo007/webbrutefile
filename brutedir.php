#!/usr/bin/php
<?php
/*
   Simples codigo base!
*/
error_reporting(0);
$url_alvo = $argv[1];
switch($url_alvo){
    case NULL:
        echo "type url!\n";
        exit(0);
        break;
}
$lst = array(
       "admin",
       "admin.html",
       "admin.php",
       "login",
       "login.php",
       "login.html",
       "wp-login",
       ".bashrc",
       ".htaccess",
       ".passwords",
       "adm",
       "adm.php",
       "adm.html",
       "index.js"
       );
foreach($lst as $linha){
        $l = $linha;   
        $r = str_replace("http://", "", $url_alvo);
        $r = str_replace("https://", "", $url_alvo); 
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "$r/$l");
		curl_setopt($c, CURLOPT_POSTFIELDS, $linha);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_exec($c) or die ("Website error!\n");
		$code = curl_getinfo($c, CURLINFO_HTTP_CODE);
		switch($code){
		   case 200:
		       echo "[+] Found > $l < response code = $code\n";
		       break;
                   case 301:
		       echo "[+] Found > $l < response code = $code\n";
		       break;
	           default:
		       echo "* Testing < $l > response code = $code\n";
		}
		curl_close($c);
}
?>
