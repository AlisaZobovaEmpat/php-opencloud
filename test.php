<?php

declare(strict_types=0);

require 'vendor/autoload.php';

use OpenCloud\Rackspace;

$client = new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array('username'=>'aaa', 'apiKey'=>'bbb'));

$service = $client->objectStoreService(null, 'ORD', 'publicURL');

$container = $service->getContainer('ccc');

echo $container->getCdn()->getCdnSslUri() ."\n";
echo $container->getCdn()->getCdnUri() ."\n";

$container->uploadObject('example.txt', fopen('composer.json', 'r+'));

$file = $container->getObject('example.txt');

$file->setContent(fopen('composer.lock', 'r+'));
$file->update();

echo ($file->getContent());

$container->deleteObject('example.txt');

$files = $container->objectList();

foreach ($files as $file) {
    echo($file->getName()."\n");
}


