<?php
require_once '../../../vendor/autoload.php';

$config = [
    'callback' => DIR_CONT.'CON_user_access.php?action=l-signin',
    'keys'     => [
                    'id' => '776t5irfzzljwl',
                    'secret' => '1Ws5yA7MescNkp6n'
                ],
    'scope'    => 'r_liteprofile r_emailaddress',
];

$adapter = new Hybridauth\Provider\LinkedIn( $config );
?>
