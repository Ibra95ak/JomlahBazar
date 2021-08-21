<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use Google\ApiCore\ApiException;
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\CryptoKey\CryptoKeyPurpose;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Cloud\Kms\V1\KeyRing;

$clientKMS = new KeyManagementServiceClient();

$projectId = 'third-nature-273904';
$location = 'global';

// Create a keyring
$keyRingId = 'test-jd-enc';
$locationName = $clientKMS::locationName($projectId, $location);
$keyRingName = $clientKMS::keyRingName($projectId, $location, $keyRingId);
try {
    $keyRing = $clientKMS->getKeyRing($keyRingName);
} catch (ApiException $e) {
    if ($e->getStatus() === 'NOT_FOUND') {
        $keyRing = new KeyRing();
        $keyRing->setName($keyRingName);
        $clientKMS->createKeyRing($locationName, $keyRingId, $keyRing);
    }
}

// Create a cryptokey
$keyId = 'test-fb-enc';
$keyName = $clientKMS::cryptoKeyName($projectId, $location, $keyRingId, $keyId);
try {
    $cryptoKey = $clientKMS->getCryptoKey($keyName);
} catch (ApiException $e) {
    if ($e->getStatus() === 'NOT_FOUND') {
        $cryptoKey = new CryptoKey();
        $cryptoKey->setPurpose(CryptoKeyPurpose::ENCRYPT_DECRYPT);
        $cryptoKey = $clientKMS->createCryptoKey($keyRingName, $keyId, $cryptoKey);
    }
}

// Encrypt and decrypt
$secret = 'My secret text';
$response = $clientKMS->encrypt($keyName, $secret);
$cipherText = $response->getCiphertext();
$enc =  base64_encode($cipherText);
$dec =  base64_decode($enc);
$response = $clientKMS->decrypt($keyName, $dec);

$plainText = $response->getPlaintext();

echo "string=".$plainText;
echo "string=".$enc;



?>
