<?php 
function banner(){
	echo "
  ______                             _     _           _                 
 / _____)                           | |   | |         | |      _         
| /      ___   ____ ___  ____   ____| |   | |____   _ | | ____| |_  ____ 
| |     / _ \ / ___) _ \|  _ \ / _  | |   | |  _ \ / || |/ _  |  _)/ _  )
| \____| |_| | |  | |_| | | | ( ( | | |___| | | | ( (_| ( ( | | |_( (/ / 
 \______)___/|_|   \___/|_| |_|\_||_|\______| ||_/ \____|\_||_|\___)____)
  [ PscyhoXploit ] [ Jogja Cyber Security ] |_|                          

Coded By 	=> Nor Ahmad				
Api From 	=> Ethical Hacker Indonesia
Github		=> github.com/norahmad/coronaupdate
";
}
function menulist(){
	echo "
=================================================================
Menu List 	=> [1] List Data Global
\t\t   [2] Ringkasan
\t\t   [3] Data Indonesia
\t\t   [4] Keluar
-----------------------------------------------------------------
Pilih menu 	> ";	
$input_menu = fopen("php://stdin","r");
$menupilih = trim(fgets($input_menu));
if ($menupilih==1) {
	getlist();
}
elseif ($menupilih==2) {
	getringkasan();
}
elseif ($menupilih==3) {
	getid();
}
elseif ($menupilih==4) {
	echo "\nThank You For Using \n";
	exit();
}
else{
	echo "\nYang Anda Masukan Tidak Sesuai \n";
	exit();
}
}
function getlist(){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.kawalcorona.com/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Authority: api.kawalcorona.com';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36 OPR/66.0.3515.115';
	$headers[] = 'Sec-Fetch-User: ?1';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
	$headers[] = 'Sec-Fetch-Site: none';
	$headers[] = 'Sec-Fetch-Mode: navigate';
	$headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close($ch);
	$jsondec = json_decode($result,1);
	// var_dump($jsondec);
	$tbl = "| %-29.29s | %7.7s | %7.7s | %9.9s |\n";
	echo "List Data Global\n";
	printf("=================================================================\n");
	printf($tbl, ' Negara', 'Positif', 'Sembuh', 'Meninggal');
	printf("=================================================================\n");
	foreach ($jsondec as $jsondec) {
		$Country_Region = $jsondec['attributes']['Country_Region'];
		$Confirmed = $jsondec['attributes']['Confirmed'];
		$Recovered = $jsondec['attributes']['Recovered'];
		$Deaths = $jsondec['attributes']['Deaths'];
		printf("-----------------------------------------------------------------\n");
		printf($tbl, $Country_Region, $Confirmed, $Recovered, $Deaths);
	}
	menulist();
}
function getringkasan(){
	error_reporting(0);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.kawalcorona.com/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Authority: api.kawalcorona.com';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36 OPR/66.0.3515.115';
	$headers[] = 'Sec-Fetch-User: ?1';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
	$headers[] = 'Sec-Fetch-Site: none';
	$headers[] = 'Sec-Fetch-Mode: navigate';
	$headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close($ch);
	$jsondec = json_decode($result,1);
	// var_dump($jsondec);
	foreach ($jsondec as $jsondec) {
		$Country_Region = $jsondec['attributes']['Country_Region'];
		if ($Country_Region=="Indonesia") {
			$id = $jsondec['attributes']['Confirmed'];
		}
		$Confirmed = $jsondec['attributes']['Confirmed'];
		$Recovered = $jsondec['attributes']['Recovered'];
		$Deaths = $jsondec['attributes']['Deaths'];
		$totalpositif=$Confirmed+$totalpositif;
		$totalsembuh=$Recovered+$totalsembuh;
		$totalmeninggal=$Deaths+$totalmeninggal;
	}
	echo "=================================================================\n";
	echo " Ringkasan Data\n\n";
	echo " Total Positif     => ".number_format($totalpositif)." Orang \n";
	echo " Total Sembuh      => ".number_format($totalsembuh)." Orang \n";
	echo " Total Meninggal   => ".number_format($totalmeninggal)." Orang \n";
	echo " Indonesia Positif => ".number_format($id)." Orang \n";
	echo "=================================================================\n";
	menulist();
}
function getid(){
	error_reporting(0);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://kawalcorona.com/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'Authority: api.kawalcorona.com';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36 OPR/66.0.3515.115';
	$headers[] = 'Sec-Fetch-User: ?1';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
	$headers[] = 'Sec-Fetch-Site: none';
	$headers[] = 'Sec-Fetch-Mode: navigate';
	$headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	curl_close($ch);
	// var_dump($result);
	preg_match_all("'<tbody>(.*?)</tbody>'si", $result, $out);
	preg_match_all("'<tr>(.*?)</tr>'si", $out[1][0], $out2);
	$tbl = "| %-3.3s | %3.3s | %7.7s | %-25.25s | %-70.70s |\n";
	printf("----------------------------------------------------------------------------------------------------------------------------\n");
	printf("Data Indonesia\n");
	printf("============================================================================================================================\n");
	printf($tbl, "No", "Umur", "Positif", "Di Rawat Di", "Keterangan");
	printf("============================================================================================================================\n");
	foreach ($out2[1] as $out2) {
		preg_match_all("'<td>(.*?)</td>'si", $out2, $out3);
		// var_dump($out3[1]);
		printf($tbl, $out3[1][0], $out3[1][1], $out3[1][2], $out3[1][3], $out3[1][4]);
		printf("----------------------------------------------------------------------------------------------------------------------------\n");
	}
	menulist();
}
banner();
menulist();
?>
