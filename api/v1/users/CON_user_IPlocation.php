<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';
/*Call Users class*/
require_once '../../../'.DIR_MOD.'IP2Location.php';
use Vectorface\Whip\Whip;
/*get client ip address*/
$whip = new Whip();
$clientIPAddress = $whip->getValidIpAddress();

/*
   Cache whole database into system memory and share among other scripts & websites
   WARNING: Please make sure your system have sufficient RAM to enable this feature
*/
//$db = new \IP2Location\Database('./databases/IP2LOCATION-LITE-DB1.BIN', \IP2Location\Database::SHARED_MEMORY);

/*
   Cache the database into memory to accelerate lookup speed
   WARNING: Please make sure your system have sufficient RAM to enable this feature
*/
// $db = new \IP2Location\Database('./databases/IP2LOCATION-LITE-DB1.BIN', \IP2Location\Database::MEMORY_CACHE);

// Default file I/O lookup
$db = new \IP2Location\Database('../../../assets/databases/IP2LOCATION-LITE-DB1.BIN', \IP2Location\Database::FILE_IO);
$records = $db->lookup($clientIPAddress, \IP2Location\Database::ALL);
echo json_encode($records);
