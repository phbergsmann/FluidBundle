<?php
$loader = require_once __DIR__.'/../../../../vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);

AnnotationRegistry::registerLoader('class_exists');

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
