<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Dopesong\Slim\Error\Whoops as WhoopsError;

require '../vendor/autoload.php';

$app = new \Slim\App;

$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/../app/Dependencies.php';
require __DIR__ . '/../app/Middleware.php';
require __DIR__ . '/../app/Routes.php';

$container = $app->getContainer();

$container['phpErrorHandler'] = $container['errorHandler'] = function($c) {
    return new WhoopsError($c->get('settings')['displayErrorDetails']);
};

$app->run();