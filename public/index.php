<?php

use Framework\Autoloader;
use Framework\HTTP\Request;
use Framework\App\AbstractFramework;
use Framework\Manager\ConnectManager;

session_start();

//Chargement du fichier functions.php
require_once '../Framework/functions.php';

//Autoloding
require_once '../Framework/Autoloader.php';

$autoload = new Autoloader();
$autoload->register();
$autoload->addNamespace('Framework', '../Framework');
$autoload->addNamespace('Application', '../Application');

//Récupération de l'url
$request = new Request();
$uri = $request->requestURI();

/**
 * Lancement de l'application selon l'url : Soit FrontFramework / soit BackFramework
 */
$component = (preg_match('#admin#', $uri['path'])) ? 'Back': 'Front';
$app = 'Framework\\App\\' . $component . 'Framework';
$framework = new $app();
$framework->run();
