<?php

require 'vendor/autoload.php'; // Make sure to include the correct path to the autoloader

use phpseclib\Crypt\RSA;

$rsa = new RSA();
$keyPair = $rsa->createKey();

$privateKey = $keyPair['privatekey'];
$publicKey = $keyPair['publickey'];

file_put_contents('private.pem', $privateKey);
file_put_contents('public.pem', $publicKey);

echo "Keys generated successfully.";
