<?php

declare(strict_types=0);

require 'vendor/autoload.php';

use OpenCloud\Rackspace;

$client = new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array('username'=>'aaa', 'apiKey'=>'bbb'));

$service = $client->objectStoreService(null, 'ORD', 'publicURL');

$container = $service->getContainer('ccc');

echo $container->getCdn()->getCdnSslUri() ."\n";
echo $container->getCdn()->getCdnUri() ."\n";

$container->uploadObject('test/ccc.txt', fopen('composer.json', 'r+'));

$file = $container->getObject('test/ccc.txt');

$file->setContent(fopen('composer.lock', 'r+'));
$file->update();

echo ($file->getContent());

$container->deleteObject('test/ccc.txt');

$files = $container->objectList();

foreach ($files as $file) {
    echo($file->getName()."\n");
}


